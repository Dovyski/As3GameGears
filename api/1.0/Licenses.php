<?php

/**
 * Display information about licenses and items.
 */
class Licenses {
	const INVALID_LICENSE	= 7002;
	
	public function index($slug="") {
		$aRet = "";

		if(empty($slug)) {
			// Display all existing licenses.
			$aRet = Db::findLicenses();
			
		} else {
			// Display items using a specific license.
			$aLicense = Db::getLicenseBySlug($slug);

			if($aLicense == null) {
				throw new RestException(self::INVALID_LICENSE, "Unknown license " . $slug);
			}
			
			$aRet				= new stdClass();
			$aRet->id			= (int)$aLicense['id'];
			$aRet->name			= $aLicense['name'];
			$aRet->slug			= $aLicense['slug'];
			$aRet->items		= array();

			foreach(Db::findItemsByLicenseId($aLicense['id']) as $aKey => $aInfo) {
				$aRet->items[] = Utils::createItem($aInfo);
			}
		}

		return $aRet;
	}
}