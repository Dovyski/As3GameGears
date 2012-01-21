<?php

/**
 * Display information about categories and their items.
 *
 */
class Categories {
	const INVALID_CATEGORY	= 6002;
	
	public function index($slug="") {
		$aRet = "";

		if(empty($slug)) {
			// Display all existing categories.
			$aRet = Db::findCategories();
			
		} else {
			// Display items from a specific category.
			$aCategory = Db::getCategoryBySlug($slug);

			if($aCategory == null) {
				throw new RestException(self::INVALID_CATEGORY, "Unknown category " . $slug);
			}
			
			$aRet				= new stdClass();
			$aRet->id			= (int)$aCategory['id'];
			$aRet->name			= $aCategory['name'];
			$aRet->slug			= $aCategory['slug'];
			$aRet->description	= $aCategory['description'];
			$aRet->items		= array();

			foreach(Db::findItemsByCategoryId($aCategory['id']) as $aKey => $aInfo) {
				$aRet->items[] = Utils::createItem($aInfo);
			}
		}

		return $aRet;
	}
}