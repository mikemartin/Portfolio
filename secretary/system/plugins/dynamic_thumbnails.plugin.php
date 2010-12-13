<?php
	hook( "site_begin", "makeDynamicThumbnail" );
	
	function dynamicThumbnail( $thumbnail, $location, $width, $height, $intelliScaling= 1, $returnHow= "full" )
	{
		global $clerk;
		
		$path= $clerk->getSetting( "cache_path", 1 );
		$url= $clerk->getSetting( "cache_path", 2 );
		
		$adaptive= ( empty( $intelliScaling ) ) ? 0 : 1;

		$file_extension= substr( $thumbnail	, strrpos( $thumbnail, '.' ) );
		$cache_file_name= str_replace( $file_extension, "", $thumbnail ) . "." . $width . "x" . $height . "_" . $adaptive . ".jpg";

		if ( file_exists( $path . $cache_file_name ) )
		{
			list( $width, $height )= getimagesize( $path . $cache_file_name );
			return ( $returnHow == "full" ) ? '<img src="' . $url . $cache_file_name . '" width="' . $width . '" height="' . $height . '" alt="" />' : $url . $cache_file_name;
		}

		return ( $returnHow == "full" ) ? '<img src="' . linkToSite() . "?dynamic_thumbnail&file=" . $location . $thumbnail . '&amp;width=' . $width . '&amp;height=' . $height . '&adaptive=' . $adaptive . '" alt="" />' : linkToSite() . "?dynamic_thumbnail&file=" . $location . $thumbnail . '&amp;width=' . $width . '&amp;height=' . $height . '&adaptive=' . $adaptive;
	}
	
	function makeDynamicThumbnail()
	{
		global $clerk;
		
		if ( isset( $_GET['dynamic_thumbnail'] ) == false )
			return;
			
		load_helper( "ThumbLib.inc" );
		
		$file			= $_GET['file'];
		$width			= $_GET['width'];
		$height			= $_GET['height'];
		$adaptive		= $_GET['adaptive'];
		
		$file_extension =	substr( $file, strrpos( $file, '.' ) );
		
		$cache_dir= $clerk->getSetting( "cache_path", 1 );
		$cache_file_name = str_replace( $file_extension, "", basename( $file ) ) . "." . $width . "x" . $height . "_" . $adaptive . ".jpg";
		$path= $cache_dir . "/" . $cache_file_name;
		
		if ( !is_dir( $cache_dir ) )
		{
			mkdir( $cache_dir );
		}
		
		$thumb=	PhpThumbFactory::create( $file, array( 'resizeUp' => true ) );
		$thumb->setFormat("JPG");

		if ( $adaptive == 0 || ( $width == 0 || $height == 0 ) )
			$thumb->resize( $width, $height );
		else
			$thumb->adaptiveResize( $width, $height );

		$thumb->save( $path );
		
		call_anchor( "modifyDynamicThumbnail", array( "path" => $path, "filename" => $cache_file_name ) );
		
		header('Content-type: image/jpeg');
		$image= imagecreatefromjpeg( $path );
		imagejpeg( $image, null, 100 );
		imagedestroy( $image );
		
		exit;
	}
?>