<?php
	error_reporting(0);
	
	define( "BASE_PATH", str_replace( "assistants/", "", $_POST['asstPath'] ) );
	define( "SYSTEM" , BASE_PATH  );
	
	require_once BASE_PATH . "assistants/helpers/file_uploader.inc.php";
	require_once BASE_PATH . "assistants/helpers/ThumbLib.inc.php";
	require_once BASE_PATH . "assistants/utf8.php";
	require_once BASE_PATH . "assistants/config.inc.php";
	require_once BASE_PATH . "assistants/clerk.php";
	require_once BASE_PATH . "assistants/guard.php";
	require_once BASE_PATH . "assistants/office.php";
	require_once BASE_PATH . "assistants/manager.php";
	
	$clerk= new Clerk( true );
	$guard=	new Guard();
	$manager= new Manager();
	
	if ( !$guard->validate_user_extern( $clerk, $_COOKIE["secretary_username"], $_COOKIE["secretary_password"] ) )
	{
		die( "Back off!");
	}
	
	define_anchor( "modifyFileThumbAfterSave" );
	define_anchor( "modifyFileThumb" );
	
	loadPlugins();
	
	$_POST= $clerk->clean( $_POST );
	
	$action= $_POST['action'];
	
	$paths= $clerk->getSetting( "projects_path" );
	$paths= array(
					'path' =>	$paths['data1'],
					'url'	=>	$paths['data2']
	);
	
	if ( $action == "uploadThumbnail" )
	{
		$project		= 	$clerk->query_fetchArray( $clerk->query_select( "projects", "", "WHERE id= '" . $_POST['id'] . "' LIMIT 1" ) );
		$id				=	$_POST['id'];
		$slug			= 	$project['slug'];
		$destination	=	$_POST['uploadPath'] . $slug . "/";
		$thumbnails		=	$clerk->getSetting( "projects_thumbnail" );
		$thumbWidth		= 	$thumbnails['data1'];
		$thumbHeight	= 	$thumbnails['data2'];
		$resizeProjThumb=	$clerk->getSetting( "resizeProjThumb", 1 );
		$intelliscaling	=	(boolean) $clerk->getSetting( "projects_intelliscaling", 1 );
		$forceAdaptive	= 	( $thumbWidth == 0 || $thumbHeight == 0 ) ? true : false;
		
		// Create set folder if it doesn't already exist
		if ( !is_dir( $destination ) )
		{
			mkdir( substr( $destination, 0, -1 ), 0755 );
		}
		
		$allowed_file_types	=	array( '.jpg', '.jpeg', '.gif', '.png' );
		
		foreach ( $_FILES['Thumbnail']['name'] as $key => $val )
		{
			$upload				= 	upload( 'Thumbnail', $key, $destination, implode( ",", $allowed_file_types ), true );
			$upload_file		= 	$upload[0];
			$upload_error		=	$upload[1];
		}
		
		if ( empty( $upload_error ) )
		{	
			$currentThumb	= 	$_POST['uploadPath'] . $slug . "/" . $project['thumbnail'];
			$deleteCurrent	= 	( file_exists( $currentThumb ) && is_file( $currentThumb ) ) ? unlink( $currentThumb ) : true;
			$file_extension =	substr( $upload_file, strrpos( $upload_file, '.' ) );
			$thumbnail_name	=	$clerk->simple_name( str_replace( array_merge( $allowed_file_types, array( ".thumbnail", ".thumb" ) ), "", $upload_file ) ) . ".project" . $file_extension;
			
			rename( $destination . $upload_file, $destination . $thumbnail_name );
			call_anchor( "modifyProjectThumbAfterSave", array( $thumb, ( $destination . $thumbnail_name ) ) );
			
			if ( $clerk->query_edit( "projects", "thumbnail= '$thumbnail_name'", "WHERE id= '$id'" ) && $deleteCurrent )
			{
				echo '<img src="' . $_POST['uploadUrl'] . $slug . '/' . $thumbnail_name . '" alt="" />';
			}
		}
		else
		{
			echo $upload_error;
		}
	}
?>