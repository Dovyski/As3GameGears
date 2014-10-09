<?php

require_once dirname(__FILE__).'/config.php';

function textGetById($theId) {
  global $gDb;

  $aRet = array();
  $aQuery = $gDb->prepare("SELECT * FROM texts WHERE id = ?");

  if ($aQuery->execute(array($theId))) {
      $aRet = $aQuery->fetch(PDO::FETCH_ASSOC);
  }

  return $aRet;
}

?>
