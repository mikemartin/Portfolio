<?php
	// Include assistants
	require_once SYSTEM . "assistants/utf8.php";
	require_once SYSTEM . "assistants/config.inc.php";
	require_once SYSTEM . "assistants/clerk.php";
	require_once SYSTEM . "assistants/guard.php";
	require_once SYSTEM . "assistants/receptionist.php";
	require_once SYSTEM . "assistants/office.php";
	require_once SYSTEM . "assistants/manager.php";
	
	// Initialise
	$manager= new Manager();
	$manager->clerk->dbConnect();
	$manager->clerk->loadSettings();
	$manager->guard->init();
	$manager->office->init();
	$manager->guard->validate_user();

	// Default anchors
	$anchors= array( 	
						"start"						=>	array(),
						"head_tags"					=>	array(),
						"css"						=>	array(),
						"javascript"				=>	array(),
						"menu"						=>	array(),
						"after_menu"				=>	array(),
						"breadcrumbActive"			=>	array(),
						"search_bar"				=>	array(),
						"search_results"			=>	array(),
						"big_message"				=>	array(),
						"before_form"				=>	array(),
						"form_process"				=>	array(),
						"form_submit_primary"		=>	array(),
						"form_submit_secondary"		=>	array(),
						"form_main"					=>	array(),
						"after_form"				=>	array(),
						"end"						=>	array()
					);
?>