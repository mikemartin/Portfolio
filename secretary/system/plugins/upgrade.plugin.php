<?php
	// The Secretary 2.2 Upgrader
	
	if ( isset( $manager ) ):
	
		if ( $manager->clerk->settingExists( "app" ) == false )
		{
			$manager->clerk->addSetting( "app", array( 0, 0, 0 ) );
		}
		else
		{
			$upgradeVersion= 2.2;
			$appVersion= $manager->clerk->getSetting( "app", 1 );
		}

		if ( $appVersion < $upgradeVersion ):
			$manager->clerk->updateSetting( "app", array( 2.2 ) );
			
			$manager->clerk->addSetting( "maintenanceMode", array( 0, "", "" ) );
			$manager->clerk->addSetting( "projects_thumbnailIntelliScaling", array( 0, 0, 0 ) );
			$manager->clerk->addSetting( "cache_path", array( BASE_PATH . "files/cache/", BASE_URL . "files/cache/", 0 ) );
			$manager->clerk->addSettings( 
				array(
						"mediamanager_path" => array( BASE_PATH . "files/media/", BASE_URL . "files/media/" ),
						"mediamanager_thumbnail" => array( "100", "100" )
					)
			);

			if ( is_dir( BASE_PATH . "files/cache" ) == false )
			{
				mkdir( BASE_PATH . "files/cache", 0777 );
			}

			if ( is_dir( BASE_PATH . "files/media" ) == false )
			{
				mkdir( BASE_PATH . "files/media", 0777 );
			}
			
			$manager->clerk->addColumn( "secretary_blog", "status", "int(10)" );
			$manager->clerk->query_edit( "secretary_blog", "status= '1'" );
			
			unlink( SYSTEM . "plugins/upgrade.plugin.php" );
		endif;
	
	endif;
?>
