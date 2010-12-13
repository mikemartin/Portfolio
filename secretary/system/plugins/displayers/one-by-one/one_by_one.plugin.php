<?php
	function one_by_one( $project, $files, $group )
	{
		global $clerk;
		
		foreach ( $files as $file => $data )
		{
			if ( $data['filegroup'] == $group['num'] )
			{
				$width= ( $data['width'] == 0 ) ? "auto" : $data['width'];
				$height= ( $data['height'] == 0 ) ? "auto" : $data['height'];
				
				switch ( $data['type'] )
				{
					case "image":
							$html.= '<div class="file">
										<img src="' . PROJECTS_URL . $project['slug'] . '/' . $data['file'] . '" width="' . $width . '" height="' . $height . '" alt="" />';
							break;
					case "video":
							$html.= '<div class="file">' . mediaplayer( $data, $project );
							break;
					case "audio":
							$html.= '<div class="file">' . audioplayer( $data, $project );
							break;
				}
				
				if ( $clerk->getSetting( "projects_hideFileInfo", 1 ) == false  && ( !empty( $data['title'] ) || !empty( $data['caption'] ) ) )
				{					
					$info_html= '<div class="info">
								<span class="title">' . $data['title'] . '</span>
								<span class="caption">' . html_entity_decode( $data['caption'] ) . '</span>';
					
					$info_html= call_anchor( "onebyone_info", array( 'html' => $info_html, 'file' => $data ) );
					
					$info= $info_html['html'] . '</div>';
				}
				
				$html.= $info . '</div>';
			}
			
			$info= "";
		}
		
		return $html;
	}
?>