<?php

class Utils {
	public static function createItem($theData, $theCategories = array(), $theLicenses = array()) {
		$aResult = new stdClass();
			
		$aResult->id 			= (int)$theData['id'];
		$aResult->name 			= $theData['name'];
		$aResult->description 	= $theData['description'];
		$aResult->excerpt 		= $theData['excerpt'];
		$aResult->sample 		= $theData['sample'];
		$aResult->license 		= array((int)$theData['license']);
		
		if(!empty($theData['license2'])) {
			$aResult->license[] = (int)$theData['license2'];			
		}

		$aResult->site 			= $theData['site'];
		$aResult->repository	= $theData['repository'];
		$aResult->twitter		= $theData['twitter'];
		$aResult->stats 		= $theData['stats'];

		return $aResult;
	}
	
	public static function castFields(& $theArray) {
		if(is_array($theArray) && count($theArray) > 0) {
			foreach($theArray as $aKey => $aValue) {
				if(is_numeric($aValue)) {
					$theArray[$aKey] = strstr($aValue, '.') !== false ? (float)$aValue : (int)$aValue;
				}
			}
		}
	}
}

?>