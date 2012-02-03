<?php
class Items {
	public function index($category="", $license="", $page=0, $size=50) {
				
		$aRet 			= new stdClass();
		$aItems			= null;

		if(empty($category)) {
			$aItems 		= Db::findItems($page, $size, $aRet->total);
			$aRet->page 	= (int)$page;
			$aRet->pagesize	= (int)$size;
			
		} else {
			if(($aCategory = Db::getCategoryBySlug($category)) == null) {
				throw new RestException(400, "unknown category slug " . $category);
			}
			
			$aItems 		= Db::findItemsByCategoryId($aCategory['id']);
			$aRet->category = $category;
		}
		
		$aLicenses		= Db::findLicenses();
		$aCategories	= Db::findCategories();
		$aRet->items 	= array();
		
		foreach($aItems as $aItem) {
			$aRet->items[] = Utils::createItem($aItem, $aCategories, $aLicenses);
		}
		
		return $aRet;
	}
}