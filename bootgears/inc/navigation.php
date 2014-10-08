<?php

require_once dirname(__FILE__).'/config.php';

function navigationMakeBreadcrumbs($theObject, $theCategories) {
  $aRet = null;

  if($theObject != null) {
      $aRet         = array();
      $aIsCategory  = isset($theObject['parent']);
      $aParent      = null;
      $aParentId    = 0;

      if($aIsCategory) {
        $aParent = array('parent' => $theObject['parent']);

      } else {
        $aParent = array('parent' => isset($theObject['category2']) ? $theObject['category2'] : $theObject['category']);
      }

      $aRet[] = array(
        'name' => $theObject['name'],
        'link' => ($aIsCategory ? 'category.php?id=' : 'item.php?id=') . $theObject['id']
      );

      $i = 0;
      do {

        $aParent = @$theCategories[$aParent['parent']];

        if($aParent) {
          $aRet[] = array('name' => $aParent['name'], 'link' => 'category.php?id=' . $aParent['id']);
        }
      } while($aParent != null && $i++ < 5);
  }
  
  return $aRet;
}

?>