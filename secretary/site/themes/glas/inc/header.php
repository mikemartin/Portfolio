<!DOCTYPE html>
<html lang="en">
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

<link rel="stylesheet" href="/wp-content/themes/michaelmartin/css/global/style.css" />
<link rel="stylesheet" href="/wp-content/themes/michaelmartin/css/timeline/style.css" />

<!--[if IE]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script src="/wp-content/themes/michaelmartin/js/jquery.js" type="text/javascript"></script>
<script src="/wp-content/themes/michaelmartin/js/jquery.firerift.js" type="text/javascript"></script>
<script src="/wp-content/themes/michaelmartin/js/index.js" type="text/javascript"></script>	

<script type="text/javascript" src="/wp-content/themes/michaelmartin/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="/wp-content/themes/michaelmartin/js/jquery.color.js"></script>
<script type="text/javascript" src="/wp-content/themes/michaelmartin/js/jquery.color.js"></script>


<!-- Fancybox -->
<script type="text/javascript" src="/wp-content/themes/michaelmartin/js/fancybox/jquery.mousewheel-3.0.2.pack.js"></script>
<script type="text/javascript" src="/wp-content/themes/michaelmartin/js/fancybox/jquery.fancybox-1.3.1.js"></script>
<link rel="stylesheet" type="text/css" href="/wp-content/themes/michaelmartin/js/fancybox/jquery.fancybox-1.3.1.css" media="screen" />


<!-- Img Center -->
<script src="/wp-content/themes/michaelmartin/js/jquery.imgCenter.minified.js" type="text/javascript"></script>	


<!-- Full Size -->
<script type="text/javascript" src="/wp-content/themes/michaelmartin/js/fullsize/jquery.fullsize.js"></script>
<link href="/wp-content/themes/michaelmartin/js/fullsize/fullsize.css" media="screen" rel="stylesheet" type="text/css" />


<script type="text/javascript">
		$(document).ready(function() {

			$("a#example2").fancybox({
				'titleShow'		: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});
			
			$("a#example3").fancybox({
				'width'				: '80%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});
			
			$("a[rel=example_group]").fancybox({
				'width'				: '80%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});
});
	</script>


<script type="text/javascript">


$(document).ready(function() {	

/************************* TABS ***************/

	//When page loads...
	$("article").hide(); //Hide all content
	$("ul#menu li:last").addClass("active").show(); //Activate first tab
	$("article:last").show(); //Show first tab content

	//On Click Event
	$("ul#menu li").click(function() {

		$("ul#menu li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$("article").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
  
  /*
  	$("#nav li").click(function() {

		$("#nav li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".article").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});*/

/************************* MENU SCROLL ***************/

	//Background color, mouseover and mouseout
	var left_value = 200;
	
	var colorOver = 'green';
	var colorOut = '#31b8da';

	//Padding, mouseover
	var padLeft = '20px';
	var padRight = '20px';
	
	//Default Padding
	var defpadLeft = $('#menu li a').css('paddingLeft');
	var defpadRight = $('#menu li a').css('paddingRight');
	
	//START POSITION
	$('#scroller').animate({left: -900}, { queue:false, duration:2000});
		
	//Animate the LI on mouse over, mouse out
	$('#menu li').click(function () {	
		//Make LI clickable
		window.location = $(this).find('a').attr('href');
		
	}).mouseover(function (){
		
		//mouse over LI and look for A element for transition
		$(this).find('a')
		//.animate( { paddingLeft: padLeft, paddingRight: padRight}, { queue:false, duration:100 } )
		/*.animate( { backgroundColor: colorOver }, { queue:false, duration:200 });*/

	}).mouseout(function () {
	
		//mouse oout LI and look for A element and discard the mouse over transition
		$(this).find('a')
		//.animate( { paddingLeft: defpadLeft, paddingRight: defpadRight}, { queue:false, duration:100 } )
		/*.animate( { backgroundColor: colorOut }, { queue:false, duration:200 });*/
	});	
	
	//Scroll the menu on mouse move above the #sidebar layer
	$('#timeline').mousemove(function(e) {

		//Sidebar Offset, Top value
		var s_top = parseInt($('#timeline').offset().top);		
		var s_left = parseInt($('#timeline').offset().left);
		
		//Sidebar Offset, Bottom value
		var s_bottom = parseInt($('#timeline').height() + s_top);
	
		//Roughly calculate the height of the menu by multiply height of a single LI with the total of LIs
		var mheight = 100;
		
		//Roughly calculate the width of the menu by multiply width of a single LI with the total of LIs
		var mwidth = 210; //parseInt($('#menu li').width() * $('#menu li').length);
	
		//I used this coordinate and offset values for debuggin
		$('#debugging_mouse_axis').html("X Axis : " + e.pageX + " | Y Axis " + e.pageY);
		$('#debugging_status').html(Math.round(((s_left - e.pageX)/100) * mheight / 2));
		
		$('#debugging_totalheight').html(mwidth);
		$('#debugging_height').html($('#menu li').width());
			
		//Calculate the top value
		//This equation is not the perfect, but it 's very close	
		var left_value = Math.round(((s_left - e.pageX)/100) * mwidth / 2);
		
		//Animate the #menu by chaging the top value
		$('#scroller').animate({left: left_value}, { queue:false, duration:500});
	});

	
});
	
</script>

</head>

<body>

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
	
?>



<div id="wrapper">

<div id="header">
	<h1><span>Michael Martin</span></h1>
	<p>Web Designer <span>&diams;</span> Vancouver, BC</p>	
	<br style="clear: right;"/>
	<ul id="nav">
		<!-- Navigation -->
		<li><a href="..//index.php">About Me</a></li>
		<li class="hover"><a href="..//browse">Browse</a></li>
		<li class="active"><a href="..//timeline">Timeline</a></li>
		<li><a href="..//contact.php">Say Hello</a></li>
	</ul>

</div>
