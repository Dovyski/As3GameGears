<?php

/**
 * This script syncs the API database with As3GameGears. The best aproach
 * for that would be a RSS sync, but for the sake of speed I will sync using
 * a direct database connection.
 * 
 * This script is supposed to be run using the command line.
 */

require_once dirname(__FILE__).'/inc/functions.php';

if($argc <= 1) {
	printCommandLineHelp();
	exit(1);
} else {
	parseCommandLineParams();	
}

// Warming up database connecitons...
dbQuery("SELECT VERSION()", 0);
dbQuery("SELECT VERSION()", 1);

// And now, it's  show time!
createNewTables();
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
		$aData['excerpt'] 		= createExcerpt($aData['description']);
		$aData['category'] 		= array();
		$aData['license'] 		= array();
		$aData['repo'] 			= '';
		$aData['twitter'] 		= '';
		$aData['stats'] 		= '';
		$aData['sample'] 		= extractAndDeleteCodeSample($aData['description']);
		
		$aRes = dbQuery("SELECT meta_key, meta_value FROM ".WP_PREFIX."postmeta WHERE meta_key LIKE 'as3gg_%' AND post_id = " . $aItem['ID']);

		if(mysql_num_rows($aRes) > 0) {
			while($aMeta = mysql_fetch_assoc($aRes)) {
				$aKey 			= str_replace('as3gg_', '', $aMeta['meta_key']);
				$aData[$aKey] 	= $aMeta['meta_value'];
			}
		}
		
		mysql_free_result($aRes);
		$aData['site'] = empty($aData['site']) ? extractProjectLink($aData['description']) : $aData['site'];
		
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
							$aData['category'][] = $aTemp['term_id'];
						}
					} else if($aTemp['taxonomy'] == 'post_tag') {
						$aData['license'][] = $aTemp['term_id'];
					}
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

destroyOldTables();
buildIndexes();
?>