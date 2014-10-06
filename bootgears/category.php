<?php
	require_once dirname(__FILE__).'/inc/globals.php';

	$aId = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;

	$aCategories = categoryFindAll(); // TODO: cache this
	$aCategory = null;
	$aItems = null;

	if($aId != 0) {
		$aCategory = categoryGetById($aId);

		if($aCategory != null) {
			$aItems = itemFindByCategoryId($aId);
		}
	}

	View::render('category', array(
		'categories' => $aCategories,
		'category' => $aCategory,
		'items' => $aItems,
		'breadcrumbs' => navigationMakeBreadcrumbs($aCategory, $aCategories)
	));
?>
