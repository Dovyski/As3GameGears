<?php
class Items {
	public function index($category="", $license="") {
		
		$aRet = new stdClass();
		
		if(empty($category)) {
			// TODO: list all items?
		} else {
			if(($aCategory = Db::getCategoryBySlug($category)) == null) {
				throw new RestException(400, "unknown category slug " . $category);
			}
			
			$aItems 		= Db::findItemsByCategoryId($aCategory['id']);
			$aRet->category = $category;
			$aRet->items 	= array();
			
			foreach($aItems as $aItem) {
				$aRet->items[] = Utils::createItem($aItem);
			}			
		}
		
		return $aRet;
	}
}