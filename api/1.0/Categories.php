<?php

/**
 * Display information about categories and their items.
 */
class Categories {
	public function index($slug = "") {
		$aRet = "";

		if(empty($slug)) {
			// Display all existing categories.
			$aRet = Db::findCategories();
			
		} else {
			// Display an specific category
			$aRet = Db::getCategoryBySlug($slug);

			if($aRet == null) {
				throw new RestException(400, "Unknown category " . $slug);
			}
		}

		return $aRet;
	}
}