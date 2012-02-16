<?php

/**
 * Functions to syncronize the API database.
 */

require_once dirname(__FILE__).'/../../1.0/Db.php';

// TODO: use an INI file or something
define('WP_PREFIX', 'wp_');

global $gDbConfig;

function printCommandLineHelp() {
	echo "Usage:\n";
	echo "  sync.php -o <origin> -d <dest>\n\n\n";
	echo "Params:\n";
	echo "  <origin> source db info in the format user:passwd@host/database_name.\n";	
	echo "  <dest>   destination db info in the format user:passwd@host/database_name.\n";
}

function parseCommandLineParams() {
	global $gDbConfig;
	global $argc;
	global $argv;
	
	$aParams = array(
		'-o' => '',
		'-d' => ''
	);
	
	for($i = 0; $i < $argc; $i++) {
		$aArg = $argv[$i];
		if(isset($aParams[$aArg])) {
			$aParams[$aArg] = isset($argv[$i + 1]) ? $argv[$i + 1] : '';
			$i++;
		}
	}
	
	foreach($aParams as $aOp => $aValue) {
		if(empty($aValue)) {
			echo "Param ".$aOp." was not informed.\n";
			exit(2);
		}
	}
	
	foreach($aParams as $aKey => $aValue) {
		$aTemp 		= array();
		$aTarget 	= $aKey == '-o' ? 'source' : 'destination'; 
		 
		preg_match('$(.+):(.*)@(.+)/(.+)$', $aValue, $aTemp);
		
		if(count($aTemp) != 5) {
			echo "Invalid ".$aTarget." database info.\nUse something like \"user:passwd@host/database_name\"\n";
			exit(3);
		}
		
		$gDbConfig[$aTarget] = array(
				'host' 		=> $aTemp[3],
				'user' 		=> $aTemp[1],
				'passwd' 	=> $aTemp[2],
				'db' 		=> $aTemp[4],
		);
	}
}

/** 
 * Query the database.
 * 
 * @param string $theSql the SQL query.
 */
function dbQuery($theSql, $theConnectionId = 0) {
	static $sConnection = array();
	global $gDbConfig;
	
	if(!isset($sConnection[$theConnectionId])) {
		$aHost = "";
		$aUser = "";
		$aPass = "";
		$aDb   = "";
		
		if($theConnectionId == 0) {
			$aHost = $gDbConfig['source']['host'];
			$aUser = $gDbConfig['source']['user'];
			$aPass = $gDbConfig['source']['passwd'];
			$aDb   = $gDbConfig['source']['db'];
						
		} else if($theConnectionId == 1) {
			$aHost = $gDbConfig['destination']['host'];
			$aUser = $gDbConfig['destination']['user'];
			$aPass = $gDbConfig['destination']['passwd'];
			$aDb   = $gDbConfig['destination']['db'];
		}
		
		$sConnection[$theConnectionId] = @mysql_connect($aHost, $aUser, $aPass, true) or die("Unable to connect to database using ".$aUser."@".$aHost);
		@mysql_select_db($aDb) or die("Unable to select database");
		mysql_set_charset("utf8", $sConnection[$theConnectionId]);
		
		echo "Connected to ".$aUser."@".$aHost."/".$aDb.". Charset: ".mysql_client_encoding($sConnection[$theConnectionId])."\n";
	}

	$aRet = mysql_query($theSql, $sConnection[$theConnectionId]) or die("SQL error: " . mysql_error($sConnection[$theConnectionId]));
	return $aRet;
}


function getTerm($theTermId, $theColumn = 'slug') {
	$theTermId 	= (int)$theTermId;
	$aRes 		= dbQuery("SELECT name, slug FROM ".WP_PREFIX."terms WHERE term_id = " . $theTermId);
	$aRet		= false;
	
	if(mysql_num_rows($aRes) > 0) {
		while($aTemp = mysql_fetch_assoc($aRes)) {
			$aRet = $aTemp[$theColumn];
		}
	}
	
	return $aRet;
}

function saveCategoriesAndLicenses($theCategories, $theLicenses) {
	echo "Adding categories:\n";
	
	foreach($theCategories as $aId => $aInfo) {
		echo "  Add ".$aInfo['slug'] . " (".$aInfo['name'].") ";
		dbQuery("INSERT IGNORE INTO ".Db::TABLE_CATEGORIES."2 (id, name, slug, description, parent) VALUES (".$aId.", '".addslashes($aInfo['name'])."', '".addslashes($aInfo['slug'])."', '".addslashes($aInfo['description'])."', ".$aInfo['parent'].")", 1);
		echo "\n";		
	}
	
	echo "\nAdding licenses:\n";
	
	foreach($theLicenses as $aSlug => $aInfo) {
		echo "  Add ".$aInfo['slug'] . " (".$aInfo['name'].") ";
		dbQuery("INSERT IGNORE INTO ".Db::TABLE_LICENSES."2 (id, name, slug) VALUES (".$aInfo['id'].", '".addslashes($aInfo['name'])."', '".addslashes($aInfo['slug'])."')", 1);
		echo "\n";
	}
	
	echo "\n";
}

function findCategories() {
	$aRes 	= dbQuery("SELECT tt.term_taxonomy_id AS id, t.name, t.slug, tt.description, tt.parent FROM ".WP_PREFIX."term_taxonomy AS tt JOIN ".WP_PREFIX."terms AS t ON tt.term_id = t.term_id OR tt.parent = tt.term_taxonomy_id  WHERE tt.taxonomy = 'category' AND t.slug NOT IN ('blog', 'blogroll')");
	$aCat	= array();
	
	if(mysql_num_rows($aRes) > 0) {
		while($aRow = mysql_fetch_assoc($aRes)) {
			$aCat[$aRow['id']] = $aRow;
		}
	}

	mysql_free_result($aRes);
	return $aCat;
}

function findLicenses() {
	$aRes 	= dbQuery("SELECT t.term_id AS id, t.name, t.slug FROM ".WP_PREFIX."term_taxonomy AS tt JOIN ".WP_PREFIX."terms AS t ON tt.term_id = t.term_id WHERE tt.taxonomy = 'post_tag' AND t.slug NOT IN ('blog', 'blogroll')");
	$aRet	= array();

	if(mysql_num_rows($aRes) > 0) {
		while($aRow = mysql_fetch_assoc($aRes)) {
			$aRet[$aRow['slug']] = $aRow;
		}
	}

	mysql_free_result($aRes);
	return $aRet;
}

function extractProjectLink($theDescription) {
	$aRet = "";
	$aStart = strpos($theDescription, "href=");
	
	if($aStart !== false) {
		$aStart += 5;
		$aLen	 = strlen($theDescription); 
		
		if($theDescription[$aStart] == '"') {
			$aStart++;
		}
		
		while($theDescription[$aStart] != '"' && $theDescription[$aStart] != ' ' && $theDescription[$aStart] != '>' && $aStart < $aLen) {
			$aRet .= $theDescription[$aStart];
			$aStart++;
		}
	}
	
	return $aRet;
}

function extractAndDeleteCodeSample(& $theDescription) {
	$aMatches = array();
	preg_match('/<pre class="brush: as3">([\w\W]*?)<\/pre>/', $theDescription, $aMatches);
	
	if(isset($aMatches[1])) {
		$theDescription = str_replace($aMatches[1], '', $theDescription);
		$theDescription = str_replace("<strong>Sample</strong>\n", '', $theDescription);
		$theDescription = str_replace('<pre class="brush: as3"></pre>', '', $theDescription);
		$theDescription = trim($theDescription);
	}
	
	return isset($aMatches[1]) ? $aMatches[1] : '';
}

function createExcerpt($theDescription) {
	$aText = strip_tags($theDescription);
	$aLimit1 = strpos($aText, '.');
	$aLimit2 = strpos($aText, ':');
	
	$aLimit1 = $aLimit1 === false ? 9999 : $aLimit1;
	$aLimit2 = $aLimit2 === false ? 9999 : $aLimit2;
	
	$aLimit  = min($aLimit1, $aLimit2);
	return trim(substr($aText, 0, $aLimit)) . '.';
}

/**
 * Inserts all collected item into the database. This method organizes the item's properties
 * in a way they can be easily searched in a database query.
 * 
 * @param array $theItem associative array describing an item.
 * @param array $theCategories array of existing categories, indexed by id.
 * @param arra $theLicenses array of existing licenses, indexed by slug.
 */
function insetIntoDb($theItem, $theCategories, $theLicenses) {
	$aCategory 	= isset($theItem['category'][0]) ? $theItem['category'][0] : 'NULL';
	$aCategory2 = isset($theItem['category'][1]) ? $theItem['category'][1] : 'NULL'; 
	$aLicense	= isset($theItem['license'][0]) ? $theItem['license'][0] : 'NULL'; 
	$aLicense2 	= isset($theItem['license'][1]) ? $theItem['license'][1] : 'NULL';
	
	dbQuery("INSERT IGNORE INTO ".Db::TABLE_ITEMS."2 (id, name, description, excerpt, category, category2, license, license2, site, repository, twitter, stats, sample) VALUES (".$theItem['id'].", '".addslashes($theItem['name'])."', '".addslashes($theItem['description'])."', '".addslashes($theItem['excerpt'])."', ".$aCategory.", ".$aCategory2.", ".$aLicense.", ".$aLicense2.", '".addslashes($theItem['site'])."', '".addslashes($theItem['repo'])."', '".addslashes($theItem['twitter'])."', '".addslashes($theItem['stats'])."', '".addslashes($theItem['sample'])."')", 1);
}

function createNewTables() {
	$aTables = array('categories', 'items', 'licenses');
	
	foreach($aTables as $aTable) {
		dbQuery("CREATE TABLE IF NOT EXISTS ".$aTable." (`id` int(11) NOT NULL) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci", 1);
	}
	
	// Create the tables we will store the new data.
	dbQuery("CREATE TABLE IF NOT EXISTS `logs` (
					  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					  `ip` varchar(16) CHARACTER SET utf8 NOT NULL,
					  `date` int(11) NOT NULL,
					  `user_agent` varchar(255) CHARACTER SET utf8 NOT NULL,
					  `uri` varchar(255) CHARACTER SET utf8 NOT NULL
					) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci", 1);
	
	dbQuery("
			CREATE TABLE IF NOT EXISTS `categories2` (
			  `id` int(11) NOT NULL,
			  `name` varchar(80) CHARACTER SET utf8 NOT NULL,
			  `slug` varchar(80) CHARACTER SET utf8 NOT NULL,
			  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
			  `parent` int(11) NOT NULL,
			  PRIMARY KEY (`id`),
			  KEY `name` (`name`,`slug`)
			) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci", 1);
	
	dbQuery("
			CREATE TABLE IF NOT EXISTS `items2` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
			  `description` text CHARACTER SET utf8 NOT NULL,
			  `excerpt` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
			  `category` int(11) NOT NULL,
			  `category2` int(11) DEFAULT NULL,
			  `license` int(11) DEFAULT NULL,
			  `license2` int(11) DEFAULT NULL,
			  `site` varchar(255) CHARACTER SET utf8 NOT NULL,
			  `repository` varchar(255) CHARACTER SET utf8 NOT NULL,
			  `twitter` varchar(80) CHARACTER SET utf8 NOT NULL,
			  `stats` varchar(80) CHARACTER SET utf8 NOT NULL,
			  `sample` text CHARACTER SET utf8,
			  PRIMARY KEY (`id`),
			  UNIQUE KEY `name` (`name`),
			  KEY `excerpt` (`excerpt`),
			  KEY `category` (`category`,`category2`),
			  KEY `license` (`license`,`license2`)
			) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci", 1);
	
	dbQuery("
			CREATE TABLE IF NOT EXISTS `licenses2` (
			  `id` int(11) NOT NULL,
			  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
			  `slug` varchar(100) CHARACTER SET utf8 NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci", 1);
}

function destroyOldTables() {	
	dbQuery("RENAME TABLE categories TO categories3, categories2 TO categories,
						  items TO items3, items2 TO items,
						  licenses TO licenses3, licenses2 TO licenses", 1);
	
	dbQuery("DROP TABLE IF EXISTS categories3, items3, licenses3", 1);
}

function buildIndexes() {
	echo "Building indexes...";
	// TODO: add indexes to db columns.
	echo "[OK]\n";
}
?>