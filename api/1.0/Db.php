<?php
class Db {
	const TABLE_ITEMS 		= "items"; 
	const TABLE_CATEGORIES 	= "categories";
	const TABLE_LICENSES 	= "licenses";
	const TABLE_LOGS 		= "logs";
	
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
		self::$mConnection = mysql_connect(DB_HOST, DB_USER, DB_PASSWD) or self::error();
		mysql_select_db(DB_NAME) or self::error();
		mysql_set_charset("utf8", self::$mConnection);
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

	public static function findItems($theCategoryId, $theLicenseId, $thePage, $thePageSize, & $theTotal) {
		$thePage		= (int)$thePage;
		$thePageSize	= (int)$thePageSize;
		$aRet 	 		= array();
		
		$aCatFilter		= empty($theCategoryId) ? "" : "(category = ".(int)$theCategoryId." OR category2 = ".(int)$theCategoryId.")";
		$aLicFilter		= empty($theLicenseId)  ? "" : "(license = ".(int)$theLicenseId." OR license2 = ".(int)$theLicenseId.")";
		
		$aLicFilter		= $aCatFilter != "" && $aLicFilter != "" ? " AND " . $aLicFilter : "";
		$aWhere			= $aCatFilter == "" && $aLicFilter == "" ? "1" : $aCatFilter." ".$aLicFilter;   
		
		$aResult 		= self::execute("SELECT COUNT(*) AS total FROM ".self::TABLE_ITEMS." WHERE ".$aWhere);
		$aCount			= self::fetchAssoc($aResult);
		$theTotal		= $aCount['total'];

		$aResult 		= self::execute("SELECT * FROM ".self::TABLE_ITEMS." WHERE ".$aWhere." ORDER BY id DESC LIMIT " . ($thePage * $thePageSize) . "," . $thePageSize);
	
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
				$aRet[$aRow['id']] = $aRow;
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
				$aRet[$aRow['id']] = $aRow;
			}
		}
		
		return $aRet;
	}
	
	public static function trackRequest() {
		self::execute("INSERT INTO ".self::TABLE_LOGS." (ip, date, user_agent, uri) VALUES ('".addslashes($_SERVER['REMOTE_ADDR'])."', ".time().", '".addslashes($_SERVER['HTTP_USER_AGENT'])."', '".addslashes($_SERVER['REQUEST_URI'])."')");
	}
}