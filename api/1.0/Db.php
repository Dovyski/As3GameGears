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
		mysql_select_db("api_as3gamegears2") or self::error();
		mysql_set_charset ( "utf8", self::$mConnection);
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
		return getCategoryBySlug($theCategorySlug) != null;
	}
	
	public static function getCategoryBySlug($theSlug) {
		$aRet 	 = null;
		$aResult = self::execute("SELECT * FROM ".self::TABLE_CATEGORIES." WHERE slug LIKE '".addslashes($theSlug)."'");
	
		if(self::numRows($aResult) > 0) {
			$aRet = self::fetchAssoc($aResult);
			Utils::castFields($aRet);
		}
	
		return $aRet;
	}
	
	public static function getLicenseBySlug($theSlug) {
		$aRet 	 = null;
		$aResult = self::execute("SELECT * FROM ".self::TABLE_LICENSES." WHERE slug LIKE '".addslashes($theSlug)."'");
	
		if(self::numRows($aResult) > 0) {
			$aRet = self::fetchAssoc($aResult);
			Utils::castFields($aRet);
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

	public static function findItems($thePage, $thePageSize, & $theTotal) {
		$thePage		= (int)$thePage;
		$thePageSize	= (int)$thePageSize;
		$aRet 	 		= array();
		
		$aResult 		= self::execute("SELECT COUNT(*) AS total FROM ".self::TABLE_ITEMS." WHERE 1");
		$aCount			= self::fetchAssoc($aResult);
		$theTotal		= $aCount['total'];
		$aResult 		= self::execute("SELECT * FROM ".self::TABLE_ITEMS." WHERE 1 ORDER BY id DESC LIMIT " . ($thePage * $thePageSize) . "," . $thePageSize);
	
		if(self::numRows($aResult) > 0) {
			while($aRow = self::fetchAssoc($aResult)) {
				Utils::castFields($aRow);
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
				Utils::castFields($aRow);
				$aRet[] = $aRow;
			}
		}
	
		return $aRet;
	}
	
	public static function findItemsByLicenseId($theLicenseId) {
		$theLicenseId	 = (int)$theLicenseId;
		$aRet 	 		 = array();
		$aResult 		 = self::execute("SELECT * FROM ".self::TABLE_ITEMS." WHERE license = " . $theLicenseId . " OR license2 = " . $theLicenseId);
	
		if(self::numRows($aResult) > 0) {
			while($aRow = self::fetchAssoc($aResult)) {
				Utils::castFields($aRow);
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
				Utils::castFields($aRow);
				$aRet[] = $aRow;
			}
		}
		
		return $aRet;
	}
	
	public static function findLicenses() {
		$aRet 	 = array();
		$aResult = self::execute("SELECT * FROM ".self::TABLE_LICENSES." WHERE 1");
		
		if(self::numRows($aResult) > 0) {
			while($aRow = self::fetchAssoc($aResult)) {
				Utils::castFields($aRow);
				$aRet[] = $aRow;
			}
		}
		
		return $aRet;
	}
}