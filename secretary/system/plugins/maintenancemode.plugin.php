<?php
	hook( "site_begin", "maintenanceMode" );
	hook( "settings-general", "maintenanceDelegates" );
	
	
	function maintenanceDelegates()
	{
		global $manager;
		
		hook( "prefsSiteSettings", "maintenanceForm" );
		hook( "form_process", "processMaintenance" );
	}
	
	function processMaintenance()
	{
		global $manager;
		
		$mMode= $_POST['maintenanceMode'];
		
		$manager->clerk->updateSetting( "maintenanceMode", array( $mMode, "", "" ) );
	}
	
	function maintenanceForm()
	{
		global $manager;
		
		$mMode= ( $manager->form->submitted() ) ? $_POST['maintenanceMode'] : $manager->clerk->getSetting( "maintenanceMode", 1 );
		$manager->form->add_input( "checkbox", "maintenanceMode", " ", $mMode, array( "Turn on Maintenance Mode" => 1 ) );
	}
	
	function maintenanceMode()
	{
		global $clerk;
		
		if ( $clerk->getSetting( "maintenanceMode", 1 ) == 1 )
		{
			echo call_anchor( "maintenanceModeMsg", "Down for maintenance! Will return shortly." );
			exit;
		}
		
		return null;
	}
?>