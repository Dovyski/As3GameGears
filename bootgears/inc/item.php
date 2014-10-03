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

?>
