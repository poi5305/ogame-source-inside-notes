<?php

/**
 * UpdatePlanetBatimentQueueList.php
 *
 * @version 1.1
 * @copyright 2008 By Chlorel for XNova
 */

/**
 * @param $CurrentPlanetd 当前星球
 * @param $CurrentUser 当前用户
 * @return bool
 * Batiment 是法语，大厦
 */
function UpdatePlanetBatimentQueueList ( &$CurrentPlanet, &$CurrentUser ) {
	$RetValue = false;

	if ( $CurrentPlanet['b_building_id'] != 0 ) {
		while ( $CurrentPlanet['b_building_id'] != 0 ) {
			if ( $CurrentPlanet['b_building'] <= time() ) {
				PlanetResourceUpdate ( $CurrentUser, $CurrentPlanet, $CurrentPlanet['b_building'], false );
				$IsDone = CheckPlanetBuildingQueue( $CurrentPlanet, $CurrentUser );

                if ( $IsDone == true ) {
					SetNextQueueElementOnTop ( $CurrentPlanet, $CurrentUser );
				}
			} else {
				$RetValue = true;
				break;
			}
		}
	}

	return $RetValue;
}

// Revision History
// - 1.0 Mise en module initiale
// - 1.1 Mise a jour des ressources sur la planete verifiable (pour prendre en compte les ressources produites
//       pendant la construction et avant l'evolution evantuel d'une mine ou d'en batiment

?>