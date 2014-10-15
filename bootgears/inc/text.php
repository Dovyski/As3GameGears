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

function textGetBySlug($theSlug) {
  global $gDb;

  $aRet = array();
  $aQuery = $gDb->prepare("SELECT * FROM texts WHERE slug = ?");

  if ($aQuery->execute(array($theSlug))) {
      $aRet = $aQuery->fetch(PDO::FETCH_ASSOC);
  }

  return $aRet;
}

function textCreateOrUpdate($theTextId, $theData) {
	global $gDb;

	$aRet					= false;
	$aId 					= $theTextId;
	$aAuthor 				= isset($theData['author']) 	? $theData['author'] 	: 1;
	$aDate 					= isset($theData['date']) 		? $theData['date'] 		: time();
	$aStatus	 			= isset($theData['status']) 	? $theData['status'] 	: '';
	$aSlug 					= isset($theData['slug']) 		? $theData['slug'] 		: '';
	$aTitle 				= isset($theData['title']) 		? $theData['title'] 	: 0;
	$aContent				= isset($theData['content'])	? $theData['content']	: 0;

	$aQuery = $gDb->prepare("INSERT INTO texts (id, author, date, status, slug, title, content) VALUES (?, ?, ?, ?, ?, ?, ?)
								ON DUPLICATE KEY UPDATE author = ?, date = ?, status = ?, slug = ?, title = ?, content = ?");

	$aParams = array($aId, $aAuthor, $aDate, $aStatus, $aSlug, $aTitle, $aContent,
					 $aAuthor, $aDate, $aStatus, $aSlug, $aTitle, $aContent);
	
	$aQuery->execute($aParams);
	$aRet = $aQuery->rowCount();
	
	return $aRet;
}

?>
