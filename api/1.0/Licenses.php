<?php

/**
 * Display information about licenses and items.
 */
class Licenses {
	public function index($slug="") {
		$aRet = "";

		if(empty($slug)) {
			// Display all existing licenses.
			$aRet = Db::findLicenses();
			
		} else {
			// Display an specific license
			$aRet = Db::getLicenseBySlug($slug);

			if($aRet == null) {
				throw new RestException(400, "Unknown license " . $slug);
			}
		}

		return $aRet;
	}
}