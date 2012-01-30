<?php
class Items {
	public function index($category="", $license="") {
		
		if(empty($category) || ($aCategory = Db::getCategoryBySlug($category)) == null) {
			throw new RestException(400, "unknown category slug " . $category);
		}

		$aItems 		= Db::findItemsByCategoryId($aCategory['id']);
		
		$aRet			= new stdClass();
		$aRet->category = $category;
		$aRet->items 	= array();
		
		foreach($aItems as $aItem) {
			$aRet->items[] = Utils::createItem($aItem);
		}
		
		return $aRet;
	}
}