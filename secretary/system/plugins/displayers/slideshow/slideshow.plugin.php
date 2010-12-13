<?php
	hook( "js_frontend", "slideshowJs" );
	
	function slideshowJs()
	{
		$self= SYSTEM_URL . "plugins/displayers/slideshow/";
		
		echo requireJs( "jquery.js", true );
		echo requireJs( $self . "jquery.cycle.js" );
	}
	
	function slideshow( $project, $files, $group )
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
				$width= ( $data['width'] == 0 ) ? "auto" : $data['width'];
				$height= ( $data['height'] == 0 ) ? "auto" : $data['height'];
				
				switch ( $data['type'] )
				{
					case "image":
							$slides.= '<div class="file">
											<img src="' . PROJECTS_URL . $project['slug'] . '/' . $data['file'] . '" width="' . $width . '" height="' . $height . '" alt="" />';
							break;
					case "video":
							$slides.= '<div class="file">' . mediaplayer( $data, $project );
							break;
					case "audio":
							$slides.= '<div class="file">' . audioplayer( $data, $project );
							break;
				}
				
				if ( $clerk->getSetting( "projects_hideFileInfo", 1 ) == false  && ( !empty( $data['title'] ) || !empty( $data['caption'] ) ) )
				{
					$info= "";	
					$info_html= '<div class="info">
								<span class="title">' . $data['title'] . '</span>
								<span class="caption">' . html_entity_decode( $data['caption'] ) . '</span>';
					
					$info_html= call_anchor( "slideshow_info", array( 'html' => $info_html, 'file' => $data ) );
					
					$info= $info_html['html'] . '</div>';
				}
				
				$slides.= $info . '</div>';
			}
			
			$info= "";
		}
		
		if ( $totalFiles == 0 ) return;
		$nav_html= <<<HTML
			<div class="slideshow-nav"><a href="#" class="prev">Previous</a> / <a href="#" class="next">Next</a> (<span class="currentSlide">1</span> of {$totalFiles})</div>
HTML;
		$nav= call_anchor( "slideshow_nav", array( "html" => $nav_html, "total_files" => $totalFiles ) );
		$jquery_slideshow_opts= call_anchor( "jquery_slideshow_opts", array( 'js' => '', 'project' => $project, 'group' => $group ) );
		
		$html= <<<HTML
			{$nav['html']}
			<div class="slides">
				{$slides}
			</div>
			
			<script type="text/javascript" charset="utf-8">
				jQuery( function($)
				{
					$("#{$project['slug']}-{$group['num']} .slides").cycle(
						{
							slideExpr: '.file',
							timeout: 0,
							speed: 500,
							next: '#{$project['slug']}-{$group['num']} .next, #{$project['slug']}-{$group['num']} .file',
							prev: '#{$project['slug']}-{$group['num']} .prev',
							prevNextClick: function(isNext, index, el)
							{
								$("#{$project['slug']}-{$group['num']} .currentSlide").text(index + 1);
							},
							{$jquery_slideshow_opts['js']}
						}
					);
				});
			</script>
HTML;
		
		return $html;
	}
?>