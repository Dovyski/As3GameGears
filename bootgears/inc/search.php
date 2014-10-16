<?php

require_once dirname(__FILE__).'/config.php';

function searchItem($theNeedle) {
  global $gDb;

  $aRet = array();
  $aQuery = $gDb->prepare("SELECT * FROM items WHERE name LIKE :query OR description LIKE :query"); // TODO: search using a special table with proper indexes.
  
  $aQuery->bindValue(':query', '%' . $theNeedle . '%');

  if ($aQuery->execute()) {
      while (($aRow = $aQuery->fetch(PDO::FETCH_ASSOC))) {
		$aRet[$aRow['id']] = $aRow;
	  }
  }

  return $aRet;
}

?>
