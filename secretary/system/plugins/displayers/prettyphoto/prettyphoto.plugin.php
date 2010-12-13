<?php
	hook( "js_frontend", "prettyJs" );
	hook( "css_frontend", "prettyCss" );
	
	function prettyCss()
	{
		$self= SYSTEM_URL . "plugins/displayers/prettyphoto/css/";
		echo requireCss( $self . "displayer.css" );
	}
	
	function prettyJs()
	{
		$self= SYSTEM_URL . "plugins/displayers/prettyphoto/js/";

		echo requireJs( "jquery.js", true );
		echo requireJs( $self . "jquery.prettyPhoto.js" );
		echo requireJs( $self . "config.js" );
	}
	
	function prettyphoto( $project, $files, $group )
	{
		global $clerk;
		
		$html= "";
		$slides= "";
		
		/*First Loop, calculate total files before next loop */
		foreach ( $files as $file => $data )
		{
			if ( $data['filegroup'] == $group['num'] )
			{
				$total++;
			}
		}		
		
		foreach ( $files as $file => $data )
		{
			if ( $data['filegroup'] == $group['num'] )
			{
				
				$bigFile		= PROJECTS_URL . $project['slug'] . '/' . $data['file'];				
				
				$thumbFile		= $data['file'];
				
				$thumbWidth		= $clerk->getSetting( "projects_filethumbnail", 1 );
				$thumbHeight	= $clerk->getSetting( "projects_filethumbnail", 2 );
				
				$intelliScaling	= $clerk->getSetting( "projects_thumbnailIntelliScaling", 1 );
				$location		= PROJECTS_URL . $project['slug'] . "/";
				$title 			= $project['title'];
				
				$thumbnail		= dynamicThumbnail( $thumbFile, $location, $thumbWidth, $thumbHeight, $intelliScaling );
				
					
				$width			= ( $data['width'] == 0 ) ? "auto" : $data['width'];
				$height			= ( $data['height'] == 0 ) ? "auto" : $data['height'];
				
				$i++;
				$projectThumb= ( $i == 1 ) ? projectThumbnail() : "";
				

				$Gallery = ( $total > 1 ) ? 'prettyPhoto[' . $project['id'] . ']' : "prettyPhoto";

				
				list( $thumbWidth, $thumbHeight )= getimagesize( $thumbnail );
				
				switch ( $data['type'] )
				{
					case "image":
							$thumbWidth= ( $thumbWidth == 0 ) ? "auto" : $thumbWidth;
							$thumbHeight= ( $thumbHeight == 0 ) ? "auto" : $thumbHeight;
		
							/* Use File thumbs for image items */
							$slides.= '<div class="project-link" id="file' . $data['id'] . '"><a href="' . $bigFile . '" rel="' . $Gallery . '" title="' . $project['text'] . '" class="thumbnail">' . $thumbnail . '</a>';	
										
							break;
					case "video":
							$title= ( empty( $data['title'] ) ) ? "Video" : $data['title'];

							/* Use Project thumb for video items */
							$slides.= '<div class="project-link" id="file' . $data['id'] . '"><a href="' . $bigFile . '?width=' . $width . '&amp;height=' . $height.'" class="thumbnail" rel="' . $Gallery . '" title="' . $project['title'] . '">' . $projectThumb . '</a>';								
							
							break;
					case "audio":
							/* Todo: Audio type */
							break;
				}
				
				
				$slides.= '</div>';
			}
			
		}
		
		return $slides;
		
	}
?>
