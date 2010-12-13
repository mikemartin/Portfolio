<?php
	remapModuleVar( "pages", "page" );
	
	// Anchors
	define_anchor( "pageTextModify" );

	// Hooks
	hook( "uri_router", "page_routes" );
	hook( "site_begin", "define_page" );
	
	$page= "";
	
	function page_routes( $routes )
	{			
		$pages= getRemappedVar( 'pages' );
		
		$routes['([a-zA-Z0-9\-_]+)']= $pages . '=$1';
		$routes['([a-zA-Z0-9\-_]+)/([a-zA-Z0-9\-_]+)']= $pages . '=$1&id=$2';
		
		return $routes;
	}
	
	function define_page()
	{
		global $page;
		
		$page= pageInfo( PAGE );
	}
	
	function pages()
	{
		return pageList();
	}
	
	function indexPage()
	{
		global $clerk;
		
		$page= pageInfo( $clerk->getSetting( "index_page", 1 ) );
		
		return $page['slug'];
	}
	
	function is_index( $page= PAGE )
	{
		return ( PAGE == indexPage() );
	}
	
	function pageSelected()
	{
		return ( empty( $_GET[getRemappedVar("pages")] ) && PAGE == "" ) ? false : true;
	}
	
	function currentPage()
	{
		return constant( "PAGE" );
	}
	
	function pageInfo( $id )
	{
		global $clerk, $page;
		
		if ( $id != $page['id'] )
		{	
			return $clerk->query_fetchArray( $clerk->query_select( "pages", "", "WHERE id= '$id' OR slug= '$id'" ) );
		}
		elseif ( empty( $page['id'] ) )
		{
			$id= PAGE;
			return $clerk->query_fetchArray( $clerk->query_select( "pages", "", "WHERE id= '$id' OR slug= '$id'" ) );
		}
		else
		{
			return $page;
		}
	}
	
	function linkToPage( $id= "")
	{
		global $page;
		
		$cleanUrls= (bool) setting( "clean_urls", 1 );
		
		if ( !empty( $id ) )
		{
			$info= pageInfo( $id );
			$slug= $info['slug'];
			$url= $info['url'];
		}
		else
		{
			$slug= $page['slug'];
			$url= $page['url'];
		}
		
		if ( empty( $url ) )
		{
			return ( $cleanUrls == true ) ? setting( "site", 2 ) . '/' . $slug : '?' . getRemappedVar( "pages" ) . '=' . $slug;
		}
		else
		{
			return $url;
		}
		
	}
	
	function pageList()
	{
		global $clerk, $page;
		
		$order= "pos";
		$orderHow= "ASC";
		
		$get= $clerk->query_select( "pages", "", "WHERE hidden= 0 ORDER BY $order $orderHow" );
		
		// ob_start();
		$contents= '<ul>';
		while ( $page= $clerk->query_fetchArray( $get ) )
		{
			$activeClass= "";
			if ( currentPage() == $page['slug'] )
			{
				$activeClass.= ' class="active"';
			}
			
			$contents.= '<li id="' . $page['slug'] . '"' . $activeClass . '><a href="' . linkToPage() . '">' . $page['name'] . '</a></li>';
		}
		$contents.= '</ul>';
        
		return $contents;
	}
		
	function pageContent( $page= "" )
	{
		global $clerk;
		
		$id= ( empty( $page ) ) ? PAGE : $page;
		
		if ( !empty( $id ) )
		{
			$page= $clerk->query_fetchArray( $clerk->query_select( "pages", "", "WHERE id='$id' OR slug='$id' LIMIT 1" ) );

			if ( $page['content_type'] == "none" ) return;

			$module= ( empty( $page['content_type'] ) ) ? "projects" : $page['content_type'];
			$options= prepare_settings( $page['content_options'] );
			return $module( $options );
		}
		
		return null;
	}
	
	function pageName()
	{
		global $page;
		
		if ( empty( $page ) ) define_page();
		
		return $page['name'];
	}
	
	function pageText( $id= "")
	{
		global $clerk;
		
		$id= ( empty( $id ) ) ? PAGE : $id;
		
		if ( !empty( $id ) )
		{
			$page= $clerk->query_fetchArray( $clerk->query_select( "pages", "", "WHERE id='$id' OR slug='$id' LIMIT 1" ) );
			
			$text= call_anchor( "pageTextModify", array(
										'original'	=>	$page['text'],
										'modified'	=>	textOutput( $page['text'] )
								)
			);
			
			return $text['modified'];
		}
	}
	
	function pageSlug()
	{
		global $page;
		
		return $page['slug'];
	}
	
	function pageId()
	{
		global $page;
		
		return $page['id'];
	}
	
	function getPages()
	{
		global $clerk;
		
		$pages= array();
		$getPages= $clerk->query_select( "pages" );
		while ( $page= $clerk->query_fetchArray( $getPages ) )
		{
			$pages[]= $page;
		}
		
		return $pages;
	}
?>