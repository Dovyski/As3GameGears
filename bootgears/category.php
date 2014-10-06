<?php
	require_once dirname(__FILE__).'/inc/globals.php';

	$aId = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;

	$aCategories = null;
	$aCategory = null;
	$aItems = null;
	$aListCategoriesOnly = false;

	if($aId != 0) {
		$aCategory = categoryGetById($aId);

		if($aCategory != null) {
			$aItems = itemFindByCategoryId($aId);
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
		'items' 					=> $aItems,
		'breadcrumbs' 				=> navigationMakeBreadcrumbs($aCategory, $aCategories)
	));
?>
