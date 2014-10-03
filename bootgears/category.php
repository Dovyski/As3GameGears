<?php
	require_once dirname(__FILE__).'/inc/globals.php';

	$aId = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;

	$aCategories = categoryFindAll();
	$aCategory = array('name' => 'Oops', 'description' => 'No such category');

	if($aId != 0) {
		$aCategory = categoryFindById($aId);
	}

	View::render('category', array(
		'categories' => $aCategories,
		'category' => $aCategory
	));
?>
