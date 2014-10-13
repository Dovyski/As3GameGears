<?php 
	require_once dirname(__FILE__).'/inc/globals.php';
	
	$aData					= array();
	$aData['categories'] 	= categoryFindAll();
	
	View::render('index', $aData);
?>