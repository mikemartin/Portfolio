<?php
	error_reporting(0);
	
	require_once "../../../assistants/utf8.php";
	require_once "../../../assistants/config.inc.php";
	require_once "../../../assistants/clerk.php";
	require_once "../../../assistants/guard.php";
	
	$clerk= new Clerk();
	$guard=	new Guard();
	
	$guard->validate_user_extern( $clerk, $_COOKIE["secretary_username"], $_COOKIE["secretary_password"] );
	
	$_POST= $clerk->clean( $_POST );
	
	$actions= explode( ",", $_POST['action']);
	foreach ( $actions as $func )
	{
			$func();
	}
	
	function newPage()
	{
		global $clerk;
		
		$name 	= 	$_POST['name'];
		$slug	= 	$clerk->simple_name( $name );
		$pos	=	$clerk->query_countRows( "pages" ) + 1;
		
		$newPage= $clerk->query_insert( "pages", "name, slug, pos", "'$name','$slug', '$pos'" );
		
		if ( $newPage )
		{
			echo $clerk->lastID();
		}
		else
		{
			echo "false";
		}
	}
	
	function orderPages()
	{
		global $clerk;
		
		parse_str( str_replace("&amp;", "&", $_POST['order']) );
		
		$count= 0;
		foreach( $page as $p )
		{
			$ok= $clerk->query_edit( "pages", "pos= '$count'", "WHERE id= '$p'" );
			$count++;
		}
		
		echo $ok;
	}
?>