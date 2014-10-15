<?php
	require_once dirname(__FILE__).'/inc/globals.php';

	$aId = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;

	$aData		= array();
	$aText 		= null;
	$aAuthor 	= null;

	if($aId != 0) {
		$aText = textGetById($aId);
	}

	if ($aText != null) {
		$aAuthor = authorGetById($aText['author']);
	}
	
	$aData['text'] = $aText;
	$aData['author'] = $aAuthor;
	$aData['showEditOption'] = true;
	$aData['editMode'] = isset($_REQUEST['edit']);

	$aBreadcrumbs = navigationMakeBreadcrumbs($aText, array());
	$aBreadcrumbs[] = array(
		'name' => 'Blog',
		'link' => '/blog/'
	);

	$aData['breadcrumbs'] = $aBreadcrumbs;
	
	View::render('text', $aData);
?>
