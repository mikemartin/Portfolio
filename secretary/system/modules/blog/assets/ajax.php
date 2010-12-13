<?php
	error_reporting(0);
	
	require_once "../../../assistants/utf8.php";
	require_once "../../../assistants/config.inc.php";
	require_once "../../../assistants/clerk.php";
	require_once "../../../assistants/guard.php";
	
	$clerk= new Clerk();
	$guard=	new Guard();
	
	if ( !$guard->validate_user_extern( $clerk, $_COOKIE["secretary_username"], $_COOKIE["secretary_password"] ) )
	{
		die( "Back off!");
	}
	
	$_POST= $clerk->clean( $_POST );
	
	$actions= explode( ",", $_POST['action']);
	foreach ( $actions as $func )
	{
			$func();
	}
	
	function newPost()
	{
		global $clerk;
		
		$title 	= 	$_POST['name'];
		$slug	= 	$clerk->simple_name( $title );
		$now	= 	getdate();
		$date	= 	mktime( $now["hours"], $now["minutes"], $now["seconds"], $now["mon"], $now["mday"], $now["year"] );
		
		$new= $clerk->query_insert( "secretary_blog", "title, slug, date, status", "'$title','$slug', '$date', '1'" );
		
		if ( $new )
		{
			echo $clerk->lastID();
		}
		else
		{
			echo "false";
		}
	}
?>