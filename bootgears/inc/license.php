<?php

require_once dirname(__FILE__).'/config.php';

function licenseFindByIdBulk($theIds) {
  global $gDb;

  $aRet = array();
  $aIds = '';

  foreach($theIds as $aId) {
    $aIds .= ((int)$aId) . ',';
  }

  $aIds = substr($aIds, 0, strlen($aIds) - 1);

  $aQuery = $gDb->prepare("SELECT * FROM licenses WHERE id IN (".$aIds.")");

  if ($aQuery->execute()) {
		while($aRow = $aQuery->fetch(PDO::FETCH_ASSOC)) {
			$aRet[$aRow['id']] = $aRow;
		}
	}

	return $aRet;
}


function licenseFindAll() {
	global $gDb;

	$aRet = array();

	$aQuery = $gDb->prepare("SELECT * FROM licenses WHERE 1");

	if ($aQuery->execute()) {
		while($aRow = $aQuery->fetch(PDO::FETCH_ASSOC)) {
			$aRet[$aRow['id']] = $aRow;
		}
	}

	return $aRet;
}

function licenseGetBySlug($theSlug) {
  global $gDb;

  $aRet = null;
  $aQuery = $gDb->prepare("SELECT * FROM licenses WHERE slug = ?");

  if ($aQuery->execute(array($theSlug))) {
      $aRet = $aQuery->fetch(PDO::FETCH_ASSOC);
  }

  return $aRet;
}

?>
