<?php

require_once dirname(__FILE__).'/config.php';

class Navigation {
	private static $mCurrentPage;
	private static $mNavTree;
	private static $mCurrentURL;

	public static function setCurrentPage($thePage) {
		self::$mCurrentPage = $thePage;
	}

	public static function setCurrentURL($theURL) {
		self::$mCurrentURL = $theURL;
	}

	public static function getCurrentURL() {
		return self::$mCurrentURL;
	}

	public static function setCurrentNavTree($theArray) {
		self::$mNavTree = $theArray;
	}

	public static function currentPage() {
		return self::$mCurrentPage;
	}

	public static function currentNavTree() {
		return self::$mNavTree;
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
			  $aRet[] = array('name' => $aParent['name'], 'link' => $aParent['slug']);
			}
		  } while($aParent != null && $i++ < 5);
	  }

	  return $aRet;
	}
}

?>
