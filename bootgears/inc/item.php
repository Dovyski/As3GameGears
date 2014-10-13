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

	$aRet					= false;
	$aId 					= $theItemId;
	$aName 					= isset($theData['name']) 				? $theData['name'] 				: '';
	$aDescription			= isset($theData['description']) 		? $theData['description'] 		: '';

	$aQuery = $gDb->prepare("INSERT INTO items (id, name, description) VALUES (?, ?, ?)
								ON DUPLICATE KEY UPDATE description = ?");

	$aParams = array($aId, $aName, $aDescription,
					 $aDescription);
	
	$aQuery->execute($aParams);
	$aRet = $aQuery->rowCount();
	
	return $aRet;
}


?>
