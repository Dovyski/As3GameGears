<?php
	require_once dirname(__FILE__).'/inc/globals.php';

	$aId = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;

	$aItem = array('name' => 'Oops', 'description' => 'No such item');

	if($aId != 0) {
		$aItem = itemGetById($aId);
	}

	View::render('item', array(
		'item'			 	=> $aItem,
		'categories'	=> categoryFindAll(),
	));
?>
