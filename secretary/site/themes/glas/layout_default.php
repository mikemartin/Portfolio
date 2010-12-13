<?php include_once "header.php"; ?>

				<?php
					if ( viewingProjectTags() ):
				?>
				<div class="section">
   		   	 		<h1 class="icon"><span>Portfolio</span></h1>
   		    		<p>Click a project to view or browse the categories on the left.</p>
				</div>
				<br/>
				
				<aside>
				<nav>
					<ul>
					    <li<? currentSection(webx);?>><a href="web">Web</a></li>
					    <li<? currentSection(animationx);?>><a href="animation">Animation</a></li>
					    <li<? currentSection(brandingx);?>><a href="branding">Branding</a></li>
					    <li<? currentSection(illustrationx);?>><a href="illustration">Illustration</a></li>
					    <li<? currentSection(printx);?>><a href="print">Print</a></li>
					   	<li<? currentSection(portfoliox);?>><a href="portfolio">Everything</a></li>
					</ul>
				</nav>
				</aside>
			
				
				<div class="projects">
					<?php
						echo projects();
					?>
				</div>

				<?php
					elseif (PAGE == timeline):
					include_once "timeline.php";
					
					elseif (PAGE == hello):
					include_once "hello.php";
				?>
					
					
				<? elseif ( $pageInfo['content_type'] == "projects" ): ?>
				
				<div class="section">
   		   	 		<h1 class="icon"><span>Portfolio</span></h1>

   		    		<p>Click a project to view or browse the categories on the left.</p>
				</div>
				<br/>
				
				<aside>
				<nav>
					<ul>
					    <li<? currentSection(webx);?>><a href="web">Web</a></li>
					    <li<? currentSection(animationx);?>><a href="animation">Animation</a></li>
					    <li<? currentSection(brandingx);?>><a href="branding">Branding</a></li>
					    <li<? currentSection(illustrationx);?>><a href="illustration">Illustration</a></li>
					    <li<? currentSection(printx);?>><a href="print">Print</a></li>	
					   	<li<? currentSection(portfoliox);?>><a href="portfolio">Everything</a></li>
					</ul>
				</nav>
				</aside>
			
				<div class="projects">
					<?php echo pageContent(); ?>
				</div>
				
				<?php
					else:
				?>
				
				<div class="section">
   		   	 		<h1 class="icon"><span><?php echo pageName(); ?></span></h1>
				</div>
				<div class="page-text">
					<?php echo pageText(); ?>
				</div>
				
				
				
				<?php
					if (PAGE == say-hello):
						include_once "contact.php";					
					endif;
				?>
					
				
				
				<?php echo pageContent(); ?>
				
				<?php
					endif;
				?>
				
				



<?php include_once "footer.php"; ?>