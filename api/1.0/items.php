<?php
class Items {
	// TODO: paginate BOTH results
	public function index($category="", $license="", $page=0, $pagesize=50) {
				
		$aRet 			= new stdClass();
		$aItems			= null;

		if(empty($category)) {
			$aItems 		= Db::findItems($page, $pagesize, $aRet->total);
			$aRet->page 	= (int)$page;
			$aRet->pagesize	= (int)$pagesize;
			
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