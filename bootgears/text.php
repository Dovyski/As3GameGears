<?php
	require_once dirname(__FILE__).'/inc/globals.php';

	$aSlug = isset($_REQUEST['slug']) ? $_REQUEST['slug'] : '';

	$aData		= array();
	$aText 		= null;
	$aAuthor 	= null;

	if($aSlug != '') {
		$aText = textGetBySlug($aSlug);
	}

	if ($aText != null) {
		$aAuthor = authorGetById($aText['author']);
	}
	
	$aData['text'] = $aText;
	$aData['author'] = $aAuthor;
	$aData['showEditOption'] = true;
	$aData['editMode'] = isset($_REQUEST['edit']);

	$aBreadcrumbs = Navigation::makeBreadcrumbs($aText, array());
	$aBreadcrumbs[] = array(
		'name' => 'Blog',
		'link' => '/blog/'
	);

	$aData['breadcrumbs'] = $aBreadcrumbs;
	
	View::render('text', $aData);
?>
