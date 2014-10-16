<?php
	require_once dirname(__FILE__).'/inc/globals.php';

	$aQuery 	= isset($_REQUEST['s']) 	? $_REQUEST['s'] 	: '';
	$aPage 		= isset($_REQUEST['page']) 	? $_REQUEST['page'] : '';
	$aItems		= array();
	$aLicenses 	= array();

	if($aQuery != '') {
		$aItems = searchItem($aQuery);
		
		foreach($aItems as $aId => $aItem) {
			if (isset($aItem['license'])) $aLicenses[$aItem['license']] = true;
			if (isset($aItem['license2'])) $aLicenses[$aItem['license2']] = true;
		}
		
		if(count($aLicenses) > 0) {
			$aLicenseIds = array_keys($aLicenses);
			$aLicenses = licenseFindByIdBulk($aLicenseIds);
		}
	}
	
	$aBreadcrumbs = array();
	$aBreadcrumbs[] = array(
		'name' => 'Search',
		'link' => '/search/'
	);
	
	$aCategories = categoryFindAll();

	View::render('search', array(
		'query' 					=> $aQuery,
		'page' 						=> 0,
		'items' 					=> $aItems,
		'categories'				=> $aCategories,
		'licenses'					=> $aLicenses,
		'breadcrumbs' 				=> $aBreadcrumbs
	));
?>
