<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title><?php echo siteTitle() . " - " . pageName() ?></title>
		<?php
			$pageInfo= pageInfo( PAGE );
			
			call_anchor("css_frontend");
			echo requireJs( "jquery.js", true );
			echo requireCss( "http://fonts.googleapis.com/css?family=Cantarell:regular,italic,bold&subset=latin" );


			// Include jQuery and jQuery Cycle if we are on the homepage
			if ( is_index() ):
				echo requireJs( SYSTEM_URL . "plugins/displayers/slideshow/jquery.cycle.js" );
			
			elseif (PAGE == timeline):
				echo requireJs( themeUrl() . "js/jquery.easing.1.3.js" );
				echo requireJs( themeUrl() . "js/timeline.js" );

				echo '<link rel="stylesheet" href="' . themeUrl() . 'css/timeline/style.css" type="text/css" media="screen" />' . "\n";
					
				$self= SYSTEM_URL . "plugins/displayers/prettyphoto/";
				echo requireCss( $self . "css/prettyPhoto.css" );
				echo requireJs( $self . "js/jquery.prettyPhoto.js" );
				
				/*echo allProjectTagList();*/ /*echo projectList();*/
			endif;
			?>

			<script type="text/javascript">                                         
				$(document).ready(function() {
						
						
			 	
			 	<? if (PAGE == about): ?>
			 		$("h1.icon").addClass("about");
			 	
			 	<? elseif ( $pageInfo['content_type'] == "projects" ): ?>
			 		$("h1.icon").addClass("portfolio");
			 		$("#portfolio").addClass("active");
			 		
			 		$("a[rel^='prettyPhoto']").prettyPhoto({ theme: 'dark_glas', opacity: 0.30, show_title: true });


			 	<? elseif (PAGE == timeline): ?>
			 		$("h1.icon").addClass("timeline");
			 		$("a[rel^='prettyPhoto']").prettyPhoto({ theme: 'dark_glas', opacity: 0.30, show_title: true });

			 	<? elseif (PAGE == say-hello): ?>
			 		$("h1.icon").addClass("hello");

				<? else : ?>

			 	<? endif; ?>	
			 						
			 	});
			 	
			 </script> 
			<?  	
			

			echo requireJs( themeUrl() . "js/actions.js" );
			
			call_anchor("js_frontend");
		?>
		<!--[if IE]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		
	</head>
	<body>
	<? $section; ?>
		<div id="wrapper">
			<div id="header">
				<div id="title">
					<a href="<?php echo linkToSite(); ?>"><h1><span><?php echo siteTitle()?></span></h1></a>
				</div>
				
				<div id="subtitle">
					<b>web design</b> + <em>development</em>
				</div>
				<br class="clear"/>
				<nav>
					<?php echo pageList(); ?>
				</nav>
			</div>

			

			
			<div id="content">

			<?php
				function currentSection($section)
				{
					if ( PAGE."x" == $section ): 
						echo " class=\"active\""; 
					endif;
				}
			
				
				if ( $pageInfo['content_type'] == "projects" ):
				/*echo allProjectTagList();*/ /*echo projectList();*/

			?>
			
			
				
			<? endif; ?>
			

			
			
	
