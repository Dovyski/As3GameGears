<?php

require_once dirname(__FILE__).'/config.php';

function navigationMakeBreadcrumbs($theObject, $theCategories) {
  $aRet = null;

  if($theObject != null) {
    /*
    if(isset($theObject['category'])) {
      // Object is an item.
      $aRet = array();

      if() {
        $aCategory = $theCategories[$theObject['category']];
        $aRet[] = array('name' => $aCategory['name'], 'link' => 'category.php?id=' . $aCategory['id']);
      }

      if(isset($theObject['category2'])) {
        $aCategory = $theCategories[$theObject['category2']];
        $aRet[] = array('name' => $aCategory['name'], 'link' => 'category.php?id=' . $aCategory['id']);
      }

      $aRet[] = array('name' => $theObject['name'], 'link' => 'item.php?id=' . $theObject['id']);

    } else if(isset($theObject['parent'])) {
    */
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

        $aParent = $theCategories[$aParent['parent']];

        if($aParent) {
          $aRet[] = array('name' => $aParent['name'], 'link' => 'category.php?id=' . $aParent['id']);
        }
      } while($aParent != null && $i++ < 5);
  }
  
  return $aRet;
}

?>
