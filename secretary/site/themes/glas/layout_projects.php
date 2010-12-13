<?php include_once "header.php"; ?>
				<div class="section">
   		   	 		<h1 class="icon"><span>
					<? $projects["slug"] ?>
   		   	 		<? //(PAGE == portfolio)? echo pageName(); : $projects["slug"] . pageName(); )?> </span></h1>
   		    		<p>Click a project to view or browse the categories on the left.
</p>
				</div>
				<br/>
				
				<aside>
				<nav>
					<ul>
					    <li<? currentSection(webx);?>><a href="/web">Web</a></li>
					    <li<? currentSection(animationx);?>><a href="/animation">Animation</a></li>
					    <li<? currentSection(brandingx);?>><a href="/branding">Branding</a></li>
					    <li<? currentSection(illustrationx);?>><a href="/illustration">Illustration</a></li>
					   <li<? currentSection(printx);?>><a href="/print">Print</a></li>	
					   <li<? currentSection(portfoliox);?>><a href="/portfolio">Everything</a></li>

					</ul>
				</nav>
				</aside>
			
				<div class="projects">
				
				<?php echo projectView(); ?>
				
				</div>

<?php include_once "footer.php"; ?>