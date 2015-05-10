<?php

require_once dirname(__FILE__).'/config.php';

function searchItem($theNeedle, & $theTotal, $thePage, $thePerPage = 15) {
  global $gDb;

  $aRet = array();

  $aQuery = $gDb->prepare("SELECT COUNT(*) AS total FROM items WHERE name LIKE :query OR description LIKE :query"); // TODO: search using a special table with proper indexes.
  $aQuery->bindValue(':query', '%' . $theNeedle . '%');
  $aQuery->execute();
  $aRow = $aQuery->fetch(PDO::FETCH_ASSOC);
  $theTotal = $aRow['total'];

  $thePage = $thePage +0;
  $thePerPage = $thePerPage +0;

  $thePage = $thePage - 1;
  $thePage = $thePage <= 0 ? 0 : $thePage;

  $aQuery = $gDb->prepare("SELECT * FROM items WHERE name LIKE :query OR description LIKE :query LIMIT ".($thePage * $thePerPage).",".$thePerPage);
  $aQuery->bindValue(':query', '%' . $theNeedle . '%');

  if ($aQuery->execute()) {
      while (($aRow = $aQuery->fetch(PDO::FETCH_ASSOC))) {
		$aRet[$aRow['id']] = $aRow;
	  }
  }

  return $aRet;
}

?>
