<?php

require_once dirname(__FILE__).'/config.php';

function categoryFindAll($theSimplified = true) {
  global $gDb;

  $aRet = array();
  $aQuery = $gDb->prepare("SELECT id, name, slug, parent".($theSimplified ? "" : ", description")." FROM categories WHERE 1 ORDER BY name ASC");

  if ($aQuery->execute()) {
		while($aRow = $aQuery->fetch(PDO::FETCH_ASSOC)) {
			$aRet[$aRow['id']] = $aRow;
		}
	}

	return $aRet;
}


function categoryGetById($theId) {
  global $gDb;

  $aRet = null;
  $aQuery = $gDb->prepare("SELECT * FROM categories WHERE id = ?");

  if ($aQuery->execute(array($theId))) {
      $aRet = $aQuery->fetch(PDO::FETCH_ASSOC);
  }

  return $aRet ? $aRet : null;
}

function categoryGetBySlug($theSlug) {
  global $gDb;

  $aRet = null;
  $aQuery = $gDb->prepare("SELECT * FROM categories WHERE slug = ?");

  if ($aQuery->execute(array($theSlug))) {
      $aRet = $aQuery->fetch(PDO::FETCH_ASSOC);
  }

  return $aRet ? $aRet : null;
}

?>
