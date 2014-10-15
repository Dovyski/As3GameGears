<?php 
	require_once dirname(__FILE__).'/inc/globals.php';
	
	$aParamsPos = strpos($_SERVER['REQUEST_URI'], '?');
	$aParamsPos = ($aParamsPos === false ? strlen($_SERVER['REQUEST_URI']) - 1 : $aParamsPos - 1);
	$aParamsPos	= ($_SERVER['REQUEST_URI'][$aParamsPos] == '/' ? $aParamsPos - 1 : $aParamsPos);
	
	$aUri 		= substr($_SERVER['REQUEST_URI'], 1, $aParamsPos);
	$aSelf 		= $_SERVER['PHP_SELF'];
	$aParts 	= explode('/', $aUri);
	$aFirst 	= isset($aParts[0]) ? $aParts[0] : '';
	
	$aCount 	= count($aParts);
	$aIndex		= $aCount - 1;
	$aLast 		= isset($aParts[$aIndex]) ? $aParts[$aIndex] : '';
	
	$aPages = array(
		'about'						=> '',
		'disclaimer'				=> '',
		'extras'					=> '',
		'as3gamegears-api'			=> '',
		'brain-rating-for-games'	=> ''
	);
	
	$aRoutes = array(
		'blog' 		=> 'blog.php',
		'category' 	=> 'category.php',
		'tag' 		=> 'tag.php',
		'search' 	=> 'search.php'
	);
	
	if (isset($aPages[$aFirst])) {
		$_REQUEST['slug'] = $aFirst;
		$aRoute = 'text.php';
		
	} else if(isset($aRoutes[$aFirst])){
		$_REQUEST['slug'] = $aLast != $aFirst ? $aLast : '';
		$aRoute = $aRoutes[$aFirst];
		
	} else {
		$_REQUEST['slug'] = $aLast;
		$aRoute = $aCount >= 2 ? 'item.php' : 'category.php';
	}
	
	Navigation::setCurrentPage($aRoute);
	require_once dirname(__FILE__).'/' . $aRoute;
?>