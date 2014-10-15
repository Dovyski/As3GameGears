<?php

require_once dirname(__FILE__).'/config.php';

function itemGetById($theId) {
  global $gDb;

  $aRet = array();
  $aQuery = $gDb->prepare("SELECT * FROM items WHERE id = ?");

  if ($aQuery->execute(array($theId))) {
      $aRet = $aQuery->fetch(PDO::FETCH_ASSOC);
  }

  return $aRet;
}

function itemGetBySlug($theSlug) {
  global $gDb;

  $aRet = array();
  $aQuery = $gDb->prepare("SELECT * FROM items WHERE name = ?"); // TODO: change to slug

  if ($aQuery->execute(array($theSlug))) {
      $aRet = $aQuery->fetch(PDO::FETCH_ASSOC);
  }

  return $aRet;
}

function itemFindByCategoryId($theCategoryId, $theSimplified = true) {
  global $gDb;

  $aRet = array();
  $aQuery = $gDb->prepare("SELECT ".($theSimplified ? 'id,name,excerpt,category,category2,license,license2' : '*')." FROM items WHERE category = ? OR category2 = ?");

  if ($aQuery->execute(array($theCategoryId, $theCategoryId))) {
      while($aRow = $aQuery->fetch(PDO::FETCH_ASSOC)) {
        $aRet[$aRow['id']] = $aRow;
      }
  }

  return $aRet;
}

function itemCreateOrUpdate($theItemId, $theData) {
	global $gDb;

	$aRet				= false;
	$aId 				= $theItemId;
	$aName 				= isset($theData['name']) 			? $theData['name'] 			: '';
	$aDescription		= isset($theData['description']) 	? $theData['description'] 	: '';
	$aCategory 			= isset($theData['category']) 		? $theData['category'] 		: '';
	$aCategory2			= isset($theData['category2']) 		? $theData['category2'] 	: '';
	$aLicense 			= isset($theData['license']) 		? $theData['license'] 		: '';
	$aLicense2 			= isset($theData['license2']) 		? $theData['license2'] 		: '';
	$aSite 				= isset($theData['site']) 			? $theData['site'] 			: '';
	$aRepository 		= isset($theData['repository']) 	? $theData['repository'] 	: '';
	$aTwitter 			= isset($theData['twitter']) 		? $theData['twitter'] 		: '';
	$aStats 			= isset($theData['stats']) 			? $theData['stats'] 		: '';
	$aSample 			= isset($theData['sample']) 		? $theData['sample'] 		: '';

	// TODO: work on name edit.
	$aQuery = $gDb->prepare("INSERT INTO items (id, name, description, category, category2, license, license2, site, repository, twitter, stats, sample) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
								ON DUPLICATE KEY UPDATE description = ?, category = ?, category2 = ?, license = ?, license2 = ?, site = ?, repository = ?, twitter = ?, stats = ?, sample = ?");

	$aParams = array($aId, $aName, $aDescription, $aCategory, $aCategory2, $aLicense, $aLicense2, $aSite, $aRepository, $aTwitter, $aStats, $aSample,
					 $aDescription, $aCategory, $aCategory2, $aLicense, $aLicense2, $aSite, $aRepository, $aTwitter, $aStats, $aSample);
	
	$aQuery->execute($aParams);
	$aRet = $aQuery->rowCount();
	
	return $aRet;
}


?>
