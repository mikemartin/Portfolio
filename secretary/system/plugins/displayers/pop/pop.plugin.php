<?php
	hook( "js_frontend", "popJs" );
	hook( "css_frontend", "popCss" );
	
	function popCss()
	{
		$self= SYSTEM_URL . "plugins/displayers/pop/";
		echo requireCss( $self . "pop.css" );
	}
	
	function popJs()
	{
		$self= SYSTEM_URL . "plugins/displayers/pop/";

		echo requireJs( "jquery.js", true );
		echo requireJs( $self . "pop.js" );
	}
	
	function pop( $project, $files, $group )
	{
		global $clerk;
		
		$html= "";
		$slides= "";
		$totalFiles= 0;
		
		foreach ( $files as $file => $data )
		{
			if ( $data['filegroup'] == $group['num'] )
			{
				$totalFiles++;
				
				$bigFile		= PROJECTS_URL . $project['slug'] . '/' . $data['file'];				
				$thumbFile		= $data['file'];
				$thumbWidth		= $clerk->getSetting( "projects_filethumbnail", 1 );
				$thumbHeight	= $clerk->getSetting( "projects_filethumbnail", 2 );
				$intelliScaling	= $clerk->getSetting( "projects_thumbnailIntelliScaling", 1 );
				$location		= PROJECTS_URL . $project['slug'] . "/";
				
				$thumbnail		= dynamicThumbnail( $thumbFile, $location, $thumbWidth, $thumbHeight, $intelliScaling, "short" );
				
				$width			= ( $data['width'] == 0 ) ? "auto" : $data['width'];
				$height			= ( $data['height'] == 0 ) ? "auto" : $data['height'];
				
				list( $thumbWidth, $thumbHeight )= getimagesize( $thumbnail );
				
				switch ( $data['type'] )
				{
					case "image":
							$thumbWidth= ( $thumbWidth == 0 ) ? "auto" : $thumbWidth;
							$thumbHeight= ( $thumbHeight == 0 ) ? "auto" : $thumbHeight;
							
							$slides.= '<div class="file" id="file' . $data['id'] . '">
											<a class="popper" onclick="popper(\''. $data['id'] . '\', \'' . $width . '\', \'' . $height . '\');return false;" href="#"><img src="' . $thumbnail . '" width="' . $thumbWidth . '" height="' . $thumbHeight . '" alt="' . $bigFile . '" alt="" /></a>';
							break;
					case "video":
							$title= ( empty( $data['title'] ) ) ? "Video" : $data['title'];
							$mediaThumb= ( empty( $data['thumbnail'] ) ) ? $title : '<img src="' . $thumbnail . '" width="' . $thumbWidth . '" height="' . $thumbHeight . '" />';

							$slides.= '<div class="file" id="file' . $data['id'] . '"><a class="popper" href="#" onclick="popper(\''. $data['id'] . '\', \'' . $width . '\', \'' . $height . '\', true);return false;">' . $mediaThumb . '</a><div class="popcontent">' . mediaplayer( $data, $project ) . '</div>';
							break;
					case "audio":
							$title= ( empty( $data['title'] ) ) ? "Audio" : $data['title'];
							$mediaThumb= ( empty( $data['thumbnail'] ) ) ? $title : '<img src="' . $thumbnail . '" width="' . $thumbWidth . '" height="' . $thumbHeight . '" />';
							
							$slides.= '<div class="file" id="file' . $data['id'] . '"><a class="popper" href="#" onclick="popper(\''. $data['id'] . '\', \'' . $width . '\', \'' . $height . '\', true);return false;">' . $mediaThumb . '</a><div class="popcontent">' . audioplayer( $data, $project ) . '</div>';
							break;
				}
				
				if ( $clerk->getSetting( "projects_hideFileInfo", 1 ) == false  && ( !empty( $data['title'] ) || !empty( $data['caption'] ) ) )
				{
					$info_html= '<div class="info">
								<span class="title">' . $data['title'] . '</span>
								<span class="caption">' . html_entity_decode( $data['caption'] ) . '</span>';
					
					$info_html= call_anchor( "pop_info", array( 'html' => $info_html, 'file' => $data ) );
					
					$info= $info_html['html'] . '</div>';
				}
				
				$slides.= $info . '</div>';
			}
			
			$info= "";
		}
		
		return $slides;
	}
?>