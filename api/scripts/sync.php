#!/usr/bin/php

<?php

/**
 * This script syncs the API database with As3GameGears. The best aproach
 * for that would be a RSS sync, but for the sake of speed I will sync using
 * a direct database connection.
 * 
 * This script is supposed to be run using a command line.
 */

require_once dirname(__FILE__).'/../1.0/Db.php';

// TODO: use an INI file or something
define('WP_PREFIX', 'wp_');

/** 
 * Query the database.
 * 
 * @param string $theSql the SQL query.
 */
function dbQuery($theSql, $theConnectionId = 0) {
	static $sConnection = array();
	
	if(!isset($sConnection[$theConnectionId])) {
		// TODO: use an INI file or something
		$aHost = "";
		$aUser = "";
		$aPass = "";
		$aDb   = "";
		
		if($theConnectionId == 0) {
			$aHost = "localhost";
			$aUser = "root";
			$aPass = "";
			$aDb   = "wordpress";
						
		} else if($theConnectionId == 1) {
			$aHost = "localhost";
			$aUser = "root";
			$aPass = "";
			$aDb   = "api_as3gamegears2";
		}
		
		$sConnection[$theConnectionId] = mysql_connect($aHost, $aUser, $aPass, true) or die("Unable to connect to database");
		mysql_select_db($aDb) or die("Unable to select database");
		mysql_set_charset("utf8", $sConnection[$theConnectionId]);
		
		echo "The current character set is: ".mysql_client_encoding($sConnection[$theConnectionId])."\n";
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
		dbQuery("INSERT IGNORE INTO ".Db::TABLE_CATEGORIES." (id, name, slug, description, parent) VALUES (".$aId.", '".addslashes($aInfo['name'])."', '".addslashes($aInfo['slug'])."', '".addslashes($aInfo['description'])."', ".$aInfo['parent'].")", 1);
		echo "\n";		
	}
	
	echo "\nAdding licenses:\n";
	
	foreach($theLicenses as $aSlug => $aInfo) {
		echo "  Add ".$aInfo['slug'] . " (".$aInfo['name'].") ";
		dbQuery("INSERT IGNORE INTO ".Db::TABLE_LICENSES." (id, name, slug) VALUES (".$aInfo['id'].", '".addslashes($aInfo['name'])."', '".addslashes($aInfo['slug'])."')", 1);
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

/**
 * Inserts all collected item into the database. This method organizes the item's properties
 * in a way they can be easily searched in a database query.
 * 
 * @param array $theItem associative array describing an item.
 * @param array $theCategories array of existing categories, indexed by id.
 * @param arra $theLicenses array of existing licenses, indexed by slug.
 */
function insetIntoDb($theItem, $theCategories, $theLicenses) {
	$aCategory 	= $theItem['category'][0];
	$aCategory2 = $theCategories[$aCategory]['parent'] != 0 ? $theCategories[$aCategory]['parent'] : 'NULL';
	$aLicense	= isset($theItem['license'][0]) ? $theItem['license'][0] : 'NULL'; 
	$aLicense2 	= isset($theItem['license'][1]) ? $theItem['license'][1] : 'NULL';
	
	dbQuery("INSERT IGNORE INTO ".Db::TABLE_ITEMS." (id, name, description, excerpt, category, category2, license, license2, site, repository, twitter, stats, sample) VALUES (".$theItem['id'].", '".addslashes($theItem['name'])."', '".addslashes($theItem['description'])."', '".addslashes($theItem['excerpt'])."', ".$aCategory.", ".$aCategory2.", ".$aLicense.", ".$aLicense2.", '".addslashes($theItem['site'])."', '".addslashes($theItem['repo'])."', '".addslashes($theItem['twitter'])."', '".addslashes($theItem['stats'])."', '".addslashes($theItem['sample'])."')", 1);
}


saveCategoriesAndLicenses(findCategories(), findLicenses());


$aResult = dbQuery("SELECT ID, post_content, post_title, post_name FROM ".WP_PREFIX."posts WHERE post_status = 'publish' AND post_type = 'post'");

if(mysql_num_rows($aResult) > 0) {
	$aCategories = findCategories();
	$aLicenses	 = findLicenses();
	
	echo "Adding items:\n";
	
	while($aItem = mysql_fetch_assoc($aResult)) {
		$aData = array();
		
		$aData['id'] 			= $aItem['ID'];
		$aData['name'] 			= $aItem['post_title'];
		$aData['description'] 	= $aItem['post_content'];
		$aData['excerpt'] 		= ""; // TODO
		$aData['category'] 		= array();
		$aData['license'] 		= array();
		$aData['repo'] 			= '';
		$aData['twitter'] 		= '';
		$aData['stats'] 		= '';
		$aData['sample'] 		= '';
		
		$aRes = dbQuery("SELECT meta_key, meta_value FROM ".WP_PREFIX."postmeta WHERE meta_key LIKE 'as3gg_%' AND post_id = " . $aItem['ID']);

		if(mysql_num_rows($aRes) > 0) {
			while($aMeta = mysql_fetch_assoc($aRes)) {
				$aKey 			= str_replace('as3gg_', '', $aMeta['meta_key']);
				$aData[$aKey] 	= $aMeta['meta_value'];
			}
		}
		
		mysql_free_result($aRes);
		
		// TODO: fill out site prop if not set.
		$aData['site'] = empty($aData['site']) ? '' : $aData['site'];
		
		// Get item category
		$aRes = dbQuery("SELECT term_taxonomy_id FROM ".WP_PREFIX."term_relationships WHERE object_id = " . $aItem['ID']);
		
		if(mysql_num_rows($aRes) > 0) {
			unset($aTermsTaxIds);
			
			while($aTemp = mysql_fetch_assoc($aRes)) {
				$aTermsTaxIds[] = $aTemp['term_taxonomy_id'];
			}
			mysql_free_result($aRes);
			
			$aResTaxonomies = dbQuery("SELECT term_taxonomy_id, term_id, taxonomy FROM ".WP_PREFIX."term_taxonomy WHERE term_taxonomy_id IN (" . implode(',', $aTermsTaxIds).") AND (taxonomy = 'category' OR taxonomy = 'post_tag')");
			
			if(mysql_num_rows($aResTaxonomies) > 0) {
				while($aTemp = mysql_fetch_assoc($aResTaxonomies)) {
					if($aTemp['taxonomy'] == 'category') {
						// We just add a category if it is a valid one.
						// If the temp item has an inexistend category, it means
						// this is an unwanted item such as a blog post or anything
						// that belogns to a category we don't want.
						if(isset($aCategories[$aTemp['term_taxonomy_id']])) {
							$aData['category'][] = $aTemp['term_taxonomy_id'];
						}
					} else if($aTemp['taxonomy'] == 'post_tag') {
						$aData['license'][] = $aTemp['term_taxonomy_id'];
					}
					
					//echo "term_id = " . $aTemp['term_id'] . " = ".getTerm($aTemp['term_id'])." (tax ".$aTemp['taxonomy'].")\n";
				}
			}
			
			mysql_free_result($aResTaxonomies);			
		}
		
		if(count($aData['category']) > 0) {
			echo "  Add " . $aData['name'] . " ";
			insetIntoDb($aData, $aCategories, $aLicenses);
		} else {
			echo "  Skip ".$aData['name'];
		}
		
		unset($aData);
		
		echo "\n";
	}
	echo "All done!\n";
}
?>