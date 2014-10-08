<?php
	require_once dirname(__FILE__).'/inc/globals.php';

	$aId = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;

	$aCategories = null;
	$aCategory = null;
	$aItems = null;
	$aListCategoriesOnly = false;
	$aLicenses = null;

	if($aId != 0) {
		$aCategory = categoryGetById($aId);

		if($aCategory != null) {
			$aItems = itemFindByCategoryId($aId);

			foreach($aItems as $aId => $aItem) {
				if (isset($aItem['license'])) $aLicenses[$aItem['license']] = true;
				if (isset($aItem['license2'])) $aLicenses[$aItem['license2']] = true;
			}
			
			$aLicenseIds = array_keys($aLicenses);
			$aLicenses = licenseFindByIdBulk($aLicenseIds);
		}
	} else {
		$aListCategoriesOnly = true;
	}
	
	$aSimplified = $aListCategoriesOnly == false;
	$aCategories = categoryFindAll($aSimplified);

	View::render('category', array(
		'categories' 				=> $aCategories,
		'category' 					=> $aCategory,
		'title' 					=> $aCategory ? $aCategory['name'] : 'Tools',
		'subtitle'					=> $aCategory ? $aCategory['description'] : 'Browse tools by category.',
		'listCategoriesOnly' 		=> $aListCategoriesOnly,
		'categoriesPerColumn' 		=> $aListCategoriesOnly ? 2 : 3,
		'showCategoryDescription' 	=> $aListCategoriesOnly,
		'showCategoryInItems' 		=> false,
		'items' 					=> $aItems,
		'licenses' 					=> $aLicenses,
		'breadcrumbs' 				=> navigationMakeBreadcrumbs($aCategory, $aCategories)
	));
?>
