<?php
	hook( "displayersList", "displayFormats" );
	
	function displayFormats( $displayers )
	{
		
		$defaults= array(
			'One by One'	=>	"one-by-one",
			'Slideshow'		=>	"slideshow",
			'Pop'			=>	"pop",
			'PrettyPhoto'	=>	"prettyphoto"
			
		);
		
		$final= array_merge( $defaults, $displayers );
		
		return $final;
	}
?>