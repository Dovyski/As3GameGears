<?php
class Items {
	public function index($category="", $license="", $page=0, $pagesize=50) {
		$aRet = new stdClass();
		
		if(!empty($category) && ($aCategory = Db::getCategoryBySlug($category)) == null) {
			throw new RestException(400, "unknown category slug " . $category);
		}
		
		if(!empty($license) && ($aLicense = Db::getLicenseBySlug($license)) == null) {
			throw new RestException(400, "unknown license slug " . $license);
		}
		
		$aCategoryId	= isset($aCategory) ? $aCategory['id'] 	: null; 
		$aLicenseId		= isset($aLicense)  ? $aLicense['id'] 	: null;

		if(!empty($category)) {
			$aRet->category = $category;
		}
		
		if(!empty($license)) {
			$aRet->license = $license;
		}
		
		$aItems 		= Db::findItems($aCategoryId, $aLicenseId, $page, $pagesize, $aRet->total);
		$aLicenses		= Db::findLicenses();
		$aCategories	= Db::findCategories();
		
		$aRet->page 	= (int)$page;
		$aRet->pagesize	= (int)$pagesize;
		$aRet->items 	= array();

		foreach($aItems as $aItem) {
			$aRet->items[] = Utils::createItem($aItem, $aCategories, $aLicenses);
		}
		
		return $aRet;
	}
}