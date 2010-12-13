<?php 
	$year = 240;
	$month = 20;
	
	$start = ($year * 3);
	
	$III = ($year * 3) - $start;
	$IV = ($year * 4) - $start;
	$V = ($year * 5) - $start;
	$VI = ($year * 6) - $start;
	$VII = ($year * 7) - $start;
	$VIII = ($year * 8) - $start;
	$IX = ($year * 9) - $start;
	$X = ($year * 10) - $start;
	
	$width = 10000;
	
?>

<div class="section">
     <?php echo pageText(); ?>
    <h1 class="icon"><span>Timeline</span></h1>
    <p>Click an event for a full description and selected work samples</p>
</div>


<div id="timeline-menu">
<!--<div class="fade-overlay"></div>-->
	<div id="scroller">
	
		<ul class="years">
		<li>2003</li>
		<li>2004</li>
		<li>2005</li>
		<li>2006</li>
		<li>2007</li>
		<li>2008</li>
		<li>2009</li>
		<li>2010</li>
		<li>2011</li>
	</ul>	
	
	<ul id="menu">
	<li>
	<a href="#event1" class="event" style="left: <?php echo ($III + ($month * 8)) ?>px; width:<?php echo (($year * 1) + ($month * 10) - 10); ?>px">
		<div class="title">Diploma in Multimedia: Internet Development</div>
		<span class="event-date">2003 - 2005</span>
	</a>
	</li><li>
	<a href="#event2" class="event" style="top: 72px; left: <?php echo ($V + ($month * 3)) ?>px; width:<?php echo (($year * 0) + ($month * 5) - 10); ?>px">
		<div class="title">Applecore Interactive</div>
		<span class="event-date">2005</span>
	</a>
	</li><li>
	<a href="#event3" class="event" style="left: <?php echo ($V + ($month * 8)) ?>px; width:<?php echo (($year * 1) + ($month * 10) - 10); ?>px">
		<div class="title">Diploma in Graphic Design</div>
		<span class="event-date">2005 - 2007</span>
	</a>
	</li><li>
	<a href="#event4" class="event" style="top: 72px; left: <?php echo ($VI + ($month * 5)) ?>px; width:<?php echo (($year * 0) + ($month * 4) - 10); ?>px">
		<div class="title">Johnson Geo Centre</div>
		<span class="event-date">2006</span>
	</a>
	</li><li>
	<a href="#event5" class="event" style="top: 72px; left: <?php echo ($VI + ($month * 11)) ?>px; width:<?php echo (($year * 0) + ($month * 4) - 10); ?>px">

		<div class="title">Bluedrop</div>
		<span class="event-date">2006 - 2007</span>
	</a>
	</li><li>
	<a href="#event6" class="event" style="top: 144px; left: <?php echo ($VII + ($month * 0)) ?>px; width:<?php echo (($year * 0) + ($month * 6) - 10); ?>px">
		<div class="title">Bristol Group</div>
		<span class="event-date">2007</span>
	</a>
	</li><li>
	<a href="#event7" class="event" style="top: 72px; left: <?php echo ($VII + ($month * 5)) ?>px; width:<?php echo (($year * 1) + ($month * 0) - 10); ?>px">
		<div class="title">Anthem Web Services</div>
		<span class="event-date">2007 - 2008</span>
	</a>
	</li><li>
	<a href="#event8" class="event" style="top: 0px; left: <?php echo ($VII + ($month * 9)) ?>px; width:<?php echo (($year * 2) + ($month * 9) - 10); ?>px">
		<div class="title">Absolute Software</div>
		<span class="event-date">2007 - 2010</span>
	</a>
	</li><li>
	<a href="#event9" class="event" style="top: 72px; left: <?php echo ($X + ($month * 8)) ?>px; width:<?php echo (($month * 3) - 10); ?>px">
		<div class="title">Evident <br/>Point</div>
		<span class="event-date">2010</span>
	</a>
	</li>
	</ul>
</div>  
</div>

<section id="content">

<article id="event1">
	
	<header>
		<h2>Multimedia: Internet Development</h2>
		<p class="details">
			Sep 2003 - Jun 2005 |  
			College of the North Atlantic, Clarenville, NL		</p>
	</header>
	
	<p>Coursework: Multimedia Authoring, Graphic Art & Design, 2D and 3D Computer Animation, Java Programming, PHP Programming, Instructional Design, Audio/Video Editing, Website Analysis & Design, CGI Programming & Database Operation, Creative Writing, Software Project Planning, Multimedia Trends, Marketing Methods & Promotional Media, Multimedia Production</p>
</article>


<article id="event2">

	<header>
		<h2>Applecore Interactive</h2>
		<p class="details">
			Apr 2005 - Aug 2005 | 
			Web Designer | 
			St. John's, NL		</p>
	</header>
	
	<p>Maintained websites, e-newsletter and search engine optimization.
</p>
</article>


<article id="event3">
	<div class="samples">
	<? echo projects($options= "limit=3,tags=graphic design"); ?>
	</div>

	<header>
		<h2>Graphic Design</h2>
		<p class="details">
			Sep 2005 - Jun 2007 | 
			College of the North Atlantic, St. John's, NL		</p>
	</header>
	

	
	<p>Coursework: Color Theory, Typography, Design Fundamentals, Design for Business, Marketing, Packaging, Corporate Identity, Page Layout, Illustration, Digital Imaging, Lithography, Silkscreen Printing, Photography, Multimedia, Publication Design, Website Design and Art History</p>
</article>


<article id="event4">
	<div class="samples">
	<? echo projects($options= "limit=3,tags=geo gifts"); ?>
	</div>
	
	<header>
		<h2>Johnson Geo Centre</h2>
		<p class="details">
			Jun 2006 - Aug 2006 | 
			Web Developer | 
			St. John's, NL		</p>
	</header>
	
	<p>Developed the Geo Gifts website and e-newsletter displaying products offered in Gift Shop. Involved product photography, production of gift shop website and complete development of a custom content management system.</p>
</article>


<article id="event5">
	
	<header>
		<h2>Bluedrop</h2>
		<p class="details">
			Dec 2006 - Jan 2007 | 
			Web Developer | 
			St. John's, NL		</p>
	</header>
	
	<p>Designed and developed e-learning website for Canadian Food Inspection Agency.</p>
</article>


<article id="event6">
	
	<header>
		<h2>Bristol Group</h2>
		<p class="details">
			Dec 2006 - Jun 2007 | 
			Junior Graphic Designer | 
			St. John's, NL		</p>
	</header>
	
	<p>Production design of multi-lingual projects including forms, brochures, billboards and credit cards. Mechanical duties including cutting, scoring, and assembling final projects.</p>
</article>


<article id="event7">
	<div class="samples">
	<? echo projects($options= "limit=3,tags=anthem"); ?>
	</div>
	
	<header>
		<h2>Anthem Web Services</h2>
		<p class="details">
			Jun 2007 - Sep 2008 | 
			Web Designer | 
			Vancouver, BC		</p>
	</header>
	
	<p>Several flash and graphic design projects for Megadeth.com.</p>
</article>


<article id="event8">
	<div class="samples">
	<? echo projects($options= "limit=3,tags=absolute"); ?>
	</div>
	
	<header>
		<h2>Absolute Software</h2>
		<p class="details">
			Sep 2007 - Jun 2010 | 
			Web Designer | 
			Vancouver, BC		</p>
	</header>

	<p>Responsibilities included website maintenance along with creation of new promotions and landing pages. Was instrumental in major website changes and redesigns to support new products and 11 languages. Other projects including developing an internal community, partner portal and microsites. Was actively involved in decision making, most notably evaluation and selection of a new CMS.</p>
</article>

<article id="event9">
	<div class="samples">
	<? echo projects($options= "limit=3,tags=evident point"); ?>
	</div>

	<header>
		<h2>Evident Point Software</h2>
		<p class="details">
			Oct 2010 - Present | 
			Web Designer | 
			Richmond, BC		</p>
	</header>

	
	<p>Projects included maintenance of the company website, designing a software logo and icon, and coding HTML/CSS for an iPad web application. </p>
</article>

</section>