#!/usr/bin/php

<?php

/**
 * This script syncs the API database with As3GameGears. The best aproach
 * for that would be a RSS sync, but for the sake of speed I will sync using
 * a direct database connection.
 * 
 * This script is supposed to be run using a command line.
 */

// TODO: use an INI file or something
define('WP_PREFIX', 'wp_');

/** 
 * Query the database.
 * 
 * @param string $theSql the SQL query.
 */
function dbQuery($theSql) {
	static $sConnection;
	
	if(!isset($sConnection)) {
		// TODO: use an INI file or something
		$sConnection = mysql_connect("localhost", "root", "") or die("Unable to connect to database");
		mysql_select_db("wordpress") or die("Unable to select database");
	}
	
	$aRet = mysql_query($theSql, $sConnection) or die("SQL error: " . mysql_error());
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

$aResult = dbQuery("SELECT ID, post_content, post_title, post_name FROM ".WP_PREFIX."posts WHERE post_status = 'publish' AND post_type = 'post'");

if(mysql_num_rows($aResult) > 0) {
	while($aItem = mysql_fetch_assoc($aResult)) {
		$aData = array();
		
		echo "Processing " . $aItem['post_title'] . "...";
		
		$aData['name'] 			= $aItem['post_title'];
		$aData['description'] 	= $aItem['post_content'];
		$aData['excerpt'] 		= ""; // TODO
		$aData['category'] 		= array();
		$aData['license'] 		= array();
		
		$aRes = dbQuery("SELECT meta_key, meta_value FROM ".WP_PREFIX."postmeta WHERE meta_key LIKE 'as3gg_%' AND post_id = " . $aItem['ID']);

		if(mysql_num_rows($aRes) > 0) {
			while($aMeta = mysql_fetch_assoc($aRes)) {
				$aKey 			= str_replace('as3gg_', '', $aMeta['meta_key']);
				$aData[$aKey] 	= $aMeta['meta_value'];
			}
		}
		
		mysql_free_result($aRes);
		
		// Get item category
		$aRes = dbQuery("SELECT term_taxonomy_id FROM ".WP_PREFIX."term_relationships WHERE object_id = " . $aItem['ID']);
		
		if(mysql_num_rows($aRes) > 0) {
			unset($aTermsTaxIds);
			
			while($aTemp = mysql_fetch_assoc($aRes)) {
				$aTermsTaxIds[] = $aTemp['term_taxonomy_id'];
			}
			mysql_free_result($aRes);
			//var_dump($aTermsTaxIds);exit();
			
			$aResTaxonomies = dbQuery("SELECT term_taxonomy_id, term_id, taxonomy FROM ".WP_PREFIX."term_taxonomy WHERE term_taxonomy_id IN (" . implode(',', $aTermsTaxIds).") AND (taxonomy = 'category' OR taxonomy = 'post_tag')");
			
			if(mysql_num_rows($aResTaxonomies) > 0) {
				while($aTemp = mysql_fetch_assoc($aResTaxonomies)) {
					//var_dump($aTemp);
					if($aTemp['taxonomy'] == 'category') {
						$aData['category'][] = getTerm($aTemp['term_id'], 'slug');
						
					} else if($aTemp['taxonomy'] == 'post_tag') {
						$aData['license'][] = getTerm($aTemp['term_id'], 'name');						
					}
					
					//echo "term_id = " . $aTemp['term_id'] . " = ".getTerm($aTemp['term_id'])." (tax ".$aTemp['taxonomy'].")\n";
				}
			}
			
			mysql_free_result($aResTaxonomies);			
		}
		
		
		var_dump($aData);
		unset($aData);
		
		echo "[OK]\n";

	}
}	











	
?>