<?php
	require_once dirname(__FILE__).'/inc/globals.php';

	$aSlug 		= isset($_REQUEST['slug']) 	? $_REQUEST['slug'] : '';
	$aPage 		= isset($_REQUEST['page']) 	? $_REQUEST['page'] : '';
	$aItems		= array();
	$aLicenses 	= array();
	$aPerPage	= 15;
	$aPages		= 0;
	$aLicense	= null;

	if($aSlug != '') {
		$aTotal	= 0;
		$aLicense = licenseGetBySlug($aSlug);

		if($aLicense != null) {
			$aItems = itemFindByLicenseIdPaginated($aLicense['id'], $aTotal, $aPage, $aPerPage);
			$aPages = (int)ceil($aTotal / $aPerPage);

			foreach($aItems as $aId => $aItem) {
				if (isset($aItem['license'])) $aLicenses[$aItem['license']] = true;
				if (isset($aItem['license2'])) $aLicenses[$aItem['license2']] = true;
			}

			if(count($aLicenses) > 0) {
				$aLicenseIds = array_keys($aLicenses);
				$aLicenses = licenseFindByIdBulk($aLicenseIds);
			}
		}
	}

	$aBreadcrumbs = array();
	if($aLicense != null) {
		$aBreadcrumbs[] = array(
			'name' => $aLicense['name'],
			'link' => '/license/' . $aLicense['slug'] . '/'
		);
	}
	$aBreadcrumbs[] = array(
		'name' => 'License',
		'link' => '/license/'
	);

	$aCategories = categoryFindAll();

	View::render('tag', array(
		'slug' 						=> $aSlug,
		'page' 						=> 0,
		'items' 					=> $aItems,
		'page' 						=> $aPage,
		'pages' 					=> $aPages,
		'currentURL' 				=> Navigation::getCurrentURL(),
		'categories'				=> $aCategories,
		'licenses'					=> $aLicenses,
		'breadcrumbs' 				=> $aBreadcrumbs
	));
?>
