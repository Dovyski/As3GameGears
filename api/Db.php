<?php
class Db {
	const TABLE_ITEMS 		= "items"; 
	const TABLE_CATEGORIES 	= "categories";
	const TABLE_LICENSES 	= "licenses";
	
	private static $mConnection = null;	
	
	private static function execute($theQuery) {
		if(self::$mConnection == null) {
			self::connect();
		}
		
		return self::query($theQuery);
	}
	
	private static function error() {
		throw new RestException(mysql_errno(), mysql_error());
	}
	
	private static function connect() {
		// TODO: get these from config file or equivalent.
		self::$mConnection = mysql_connect("localhost", "root", "") or self::error();
		mysql_select_db("api_as3gamegears") or self::error();
	}
	
	private static function query($theSql) {
		$aRet = mysql_query($theSql, self::$mConnection) or self::error();
		return $aRet;
	}
	
	private static function numRows($theResult) {
		return mysql_num_rows($theResult);
	}

	private static function fetchAssoc($theResult) {
		return mysql_fetch_assoc($theResult);
	}	
	
	public static function findItemByName($theItemName) {
		$aRet 	 = array();
		$aResult = self::execute("SELECT * FROM ".self::TABLE_ITEMS." WHERE name LIKE '".addslashes($theItemName)."'");

		if(self::numRows($aResult) > 0) {
			while($aRow = self::fetchAssoc($aResult)) {
				$aRet[] = $aRow; 
			}
		}
		
		return $aRet;
	}
	
	public static function categoryExists($theCategorySlug) {
		// TODO: implement
		return true;
	}
	
	public static function getCategoryBySlug($theSlug) {
		$aRet 	 = null;
		$aResult = self::execute("SELECT * FROM ".self::TABLE_CATEGORIES." WHERE slug LIKE '".addslashes($theSlug)."'");
	
		if(self::numRows($aResult) > 0) {
			$aRet = self::fetchAssoc($aResult);
		}
	
		return $aRet;
	}
	
	public static function search($theText, $theCategory = null) {
		// TODO: improve search by using several columns.
		$aCat	 = empty($theCategory) ? "" : " AND category = '".addslashes($theCategory)."'";
		$aRet 	 = array();
		$aResult = self::execute("SELECT * FROM ".self::TABLE_ITEMS." WHERE name LIKE '%".addslashes($theText)."%'" . $aCat);
	
		if(self::numRows($aResult) > 0) {
			while($aRow = self::fetchAssoc($aResult)) {
				$aRet[] = $aRow;
			}
		}
	
		return $aRet;
	}
	
	public static function findItemsByCategoryId($theCategoryId) {
		$theCategoryId	 = (int)$theCategoryId;
		$aRet 	 		 = array();
		$aResult 		 = self::execute("SELECT * FROM ".self::TABLE_ITEMS." WHERE category = " . $theCategoryId . " OR category2 = " . $theCategoryId);
	
		if(self::numRows($aResult) > 0) {
			while($aRow = self::fetchAssoc($aResult)) {
				$aRet[] = $aRow;
			}
		}
	
		return $aRet;
	}
	
	public static function findCategories() {
		$aRet 	 = array();
		$aResult = self::execute("SELECT * FROM ".self::TABLE_CATEGORIES." WHERE 1");
		
		if(self::numRows($aResult) > 0) {
			while($aRow = self::fetchAssoc($aResult)) {
				$aRet[] = $aRow;
			}
		}
		
		return $aRet;
	}
	
	public static function findLicenses() {
		
	}
}