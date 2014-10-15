<?php

require_once dirname(__FILE__).'/config.php';

class Navigation {
	private static $mCurrentPage;

	public static function setCurrentPage($thePage) {
		self::$mCurrentPage = $thePage;
	}
	
	public static function currentPage() {
		return self::$mCurrentPage;
	}
	
	public static function makeBreadcrumbs($theObject, $theCategories) {
	  $aRet = null;

	  if($theObject != null) {
		  $aRet         = array();
		  $aIsCategory  = isset($theObject['parent']);
		  $aParent      = null;
		  $aParentId    = 0;

		  if($aIsCategory) {
			$aParent = array('parent' => $theObject['parent']);

		  } else {
			$aParent = array('parent' => isset($theObject['category2']) ? $theObject['category2'] : @$theObject['category']);
		  }

		  $aRet[] = array(
			'name' => isset($theObject['name']) ? $theObject['name'] : $theObject['title'],
			'link' => ($aIsCategory ? '/category/' : '') . $theObject['slug']
		  );

		  $i = 0;
		  do {

			$aParent = @$theCategories[$aParent['parent']];

			if($aParent) {
			  $aRet[] = array('name' => $aParent['name'], 'link' => '/category/' . $aParent['slug']);
			}
		  } while($aParent != null && $i++ < 5);
	  }

	  return $aRet;
	}
}

?>
