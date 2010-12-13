<?php
	/*
	 * The Secretary
	 * by Mikael Stær (www.secretarycms.com, www.mikaelstaer.com)
	 *
	 * A portfolio management system for designers.
	 */
	
	header('Content-type: text/html; charset=utf-8');
	
	if ( !isset($_GET['debug']) )
		error_reporting(0);
	
	ob_start();

	define( 'VERSION', '2.2' );
	define( 'VERSION_DATE', 'November 1 2010' );
	define( "BASE_PATH", dirname( $_SERVER["SCRIPT_FILENAME"] ) . "/" );
	define( "BASE_URL", str_replace( basename(__FILE__), "", $_SERVER['SCRIPT_URI'] ) );
	define( "SYSTEM" , BASE_PATH  . "system/" );
	define( "SYSTEM_URL", BASE_URL  . "system/" );
	
	$mini= ( $_GET['mini'] == true ) ? true : false;
	define( "MINI", $mini );
	
	require_once SYSTEM . "assistants/launch.php";
	
	loadModules();
	loadPlugins();
	
	$manager->office->generateMenu();
	
	call_anchor( $manager->office->cubicle( "BRANCH" ) );
	call_anchor( $manager->office->cubicle('REQUEST') );
	call_anchor( "start" );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title><?php $manager->office->pageTitle(); ?></title>
		<?php
			$manager->office->head_tags();
			call_anchor( "head_tags" );
			call_anchor( "css" );
			call_anchor( "javascript" );
		?>
	</head>
	<body>
		<div id="layout">
			<div id="header">
				<div id="navHolder">
					<div id="nav" class="center">
						<?php
							$manager->office->printMenu();
							
							call_anchor( "after_menu" );

							if ( !MINI ):
						?>
						<div id="userBar">
							<?php
								$siteInfo= $manager->getSetting( "site" );
							?>
							<a href="<?php echo $siteInfo['data2']; ?>"><strong><?php echo $siteInfo['data1']; ?></strong></a> / <a href="logout.php">Logout</a>
						</div>
						<?php
							endif;
						?>
					</div>
				</div>
				<div id="titleHolder">
					<div id="title" class="center">
						<?php
							//if ( !MINI ):
						?>
						<h1><?php echo $manager->office->make_breadcrumb(); ?> <span class="active"><?php call_anchor( "breadcrumbActive" ); ?></span></h1>
						<div id="appTitle">
							<a href="http://www.secretarycms.com">The Secretary</a>
						</div>
						<?php
							/*else:
								call_anchor( "miniTitle" );
							endif;*/
						?>
					</div>
				</div>
				<?php
					if ( countHooks( "search_bar" ) > 0 ):
				?>
				<div id="searchBarHolder">
					<div id="searchBar" class="center">
						<div id="searchForm">
							
						</div>
						<div id="searchResults">
							<?php
								call_anchor( "search_results" );
							?>
						</div>
					</div>
				</div>
				<?php
					endif;
				?>
			</div>
			<div id="formMessage">
				<?php
					call_anchor( "big_message" );
					
					$manager->form= new Receptionist( "input", "post", $manager->office->URIquery(), "submit", "multipart/form-data", "process" );
					$manager->form->save_state();
				?>
			</div>
			
			<div id="app" class="center">
				<?php
					call_anchor( "before_form" );
					
					function process()
					{
						global $manager;
						
						$_POST= $manager->clerk->clean( $_POST );
						
						call_anchor( "form_process" );
					}
					
					
					$manager->form->draw();
					
					if ( countHooks( "form_submit_primary" ) > 0 || countHooks( "form_submit_secondary" ) > 0 ):
					
						$manager->form->set_template( "row_start", "" );
						$manager->form->set_template( "row_end", "" );
				?>
				
				<div class="formButtons">
					<div class="primary">
						<?php
							call_anchor( "form_submit_primary" );
							$manager->form->draw();
						?>
					</div>
					<div class="secondary">
						<?php
							call_anchor( "form_submit_secondary" );
							$manager->form->draw();
							
							$manager->form->reset_template( "row_start" );
							$manager->form->reset_template( "row_end" );
						?>
					</div>
				</div>
				
				<?php
					endif;
					
					call_anchor("form_main");
					$manager->form->draw();
					
					if ( countHooks( "form_submit_primary" ) > 0 || countHooks( "form_submit_secondary" ) > 0 ):
				?>
				
				<div class="formButtons">
					<div class="primary">
						<?php
							$manager->form->set_template( "row_start", "" );
							$manager->form->set_template( "row_end", "" );
							
							call_anchor( "form_submit_primary" );
							$manager->form->draw();
						?>
					</div>
					<div class="secondary">
						<?php
							call_anchor( "form_submit_secondary" );
							$manager->form->draw();
							
							$manager->form->reset_template( "row_start" );
							$manager->form->reset_template( "row_end" );
						?>
					</div>
				</div>
				<?php
					endif;
					
					$manager->form->close();
					
					call_anchor( "after_form" );
				?>
			</div>
		</div>
		<?php
			call_anchor( "end" );
		?>
	</body>
</html>
<?php
	ob_flush();
?>