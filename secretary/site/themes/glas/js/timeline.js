if( typeof(jQuery) !== 'undefined' ) 
	jQuery(document).ready(
		function($)
		{

/************************* EVENTS ***************/

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
  


/************************* TIMELINE SCROLL ***************/

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
	$('#scroller').animate({left: -1000}, { queue:false, duration:2000});
		
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
	$('#timeline-menu').mousemove(function(e) {

		//Sidebar Offset, Top value
		var s_top = parseInt($('#timeline-menu').offset().top);		
		var s_left = parseInt($('#timeline-menu').offset().left);
		
		//Sidebar Offset, Bottom value
		var s_bottom = parseInt($('#timeline-menu').height() + s_top);
	
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

	
	}
);
	