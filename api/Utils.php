<?php

class Utils {
	public static function createItem($theData, $theCategories = array(), $theLicenses = array()) {
		$aResult = new stdClass();
			
		$aResult->name 			= $theData['name'];
		$aResult->description 	= $theData['description'];
		$aResult->excerpt 		= $theData['excerpt'];
		$aResult->sample 		= $theData['sample'];
		$aResult->license 		= array($theData['license'], $theData['license2']); // TODO: get names instead
		$aResult->site 			= $theData['site'];
		$aResult->repository	= $theData['repository'];
		$aResult->twitter		= $theData['twitter'];
		$aResult->stats 		= $theData['stats'];
		
		return $aResult;
	}
}

?>