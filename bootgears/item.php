<?php
	require_once dirname(__FILE__).'/inc/globals.php';

	$aId = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;

	$aData				= array();
	$aItem 				= array('name' => 'Oops', 'description' => 'No such item');
	$aLicenses  		= null;
	
	// TODO: check it properly
	$aShowEditOption	= true;
	$aEditMode			= isset($_REQUEST['edit']);

	if($aId != 0) {
		$aItem = itemGetById($aId);
	}

	if($aItem != null) {
		$aData['item'] = $aItem;
		$aData['license'] = '';
		$aLicenses = licenseFindByIdBulk(array($aItem['license'], $aItem['license2']));

		if($aItem['license']) {
			$aData['license'] .= $aLicenses[$aItem['license']]['name'];
		}

		if($aItem['license2']) {
			$aData['license'] .= ', ' . $aLicenses[$aItem['license2']]['name'];
		}

		$aData['developer'] 	= utilsMakePrettyDeveloperLink($aItem);
		$aData['site'] 			= utilsMakePrettyWebsiteLink($aItem['site'], 18);
		$aData['repository'] 	= utilsMakePrettyRepoLink($aItem['repository']);
		$aData['social_repo'] 	= utilsGetSocialRepoStuff($aItem['repository']);
	}

	$aData['categories'] 		= categoryFindAll();
	$aData['showEditOption'] 	= $aShowEditOption;
	$aData['editMode'] 			= $aEditMode;
	
	if ($aEditMode) {
		$aData['licenses'] = licenseFindAll();
	}
	
	$aBreadcrumbs = navigationMakeBreadcrumbs($aItem, $aData['categories']);
	$aBreadcrumbs[] = array(
		'name' => 'Tools',
		'link' => '/category/'
	);
	
	$aData['breadcrumbs'] = $aBreadcrumbs;

	View::render('item', $aData);
?>
