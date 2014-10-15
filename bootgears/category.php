<?php
	require_once dirname(__FILE__).'/inc/globals.php';

	$aSlug = isset($_REQUEST['slug']) ? $_REQUEST['slug'] : '';

	$aCategories = null;
	$aCategory = null;
	$aItems = null;
	$aListCategoriesOnly = false;
	$aLicenses = null;

	if($aSlug != '') {
		$aCategory = categoryGetBySlug($aSlug);

		if($aCategory != null) {
			$aItems = itemFindByCategoryId($aCategory['id']);

			foreach($aItems as $aId => $aItem) {
				if (isset($aItem['license'])) $aLicenses[$aItem['license']] = true;
				if (isset($aItem['license2'])) $aLicenses[$aItem['license2']] = true;
				
				if (strlen($aItem['excerpt']) > 130) {
					$aItems[$aId]['excerpt'] = substr($aItem['excerpt'], 0, 130) . '...';
				}
			}
			
			if($aLicenses != null) {
				$aLicenseIds = array_keys($aLicenses);
				$aLicenses = licenseFindByIdBulk($aLicenseIds);
			}
		} else {
			// Category not found
			utilsMakeNotFoundHeader();
			View::render('404');
			
			exit();
		}
	} else {
		$aListCategoriesOnly = true;
	}
	
	$aSimplified = $aListCategoriesOnly == false;
	$aCategories = categoryFindAll($aSimplified);
	
	$aBreadcrumbs = Navigation::makeBreadcrumbs($aCategory, $aCategories);
	$aBreadcrumbs[] = array(
		'name' => 'Tools',
		'link' => '/category/'
	);

	View::render('category', array(
		'categories' 				=> $aCategories,
		'category' 					=> $aCategory,
		'title' 					=> $aCategory ? $aCategory['name'] : 'Tools',
		'subtitle'					=> $aCategory ? $aCategory['description'] : 'Browse tools by category.',
		'listCategoriesOnly' 		=> $aListCategoriesOnly,
		'categoriesPerColumn' 		=> $aListCategoriesOnly ? 2 : 4,
		'showCategoryDescription' 	=> $aListCategoriesOnly,
		'showCategoryInItems' 		=> false,
		'items' 					=> $aItems,
		'licenses' 					=> $aLicenses,
		'breadcrumbs' 				=> $aBreadcrumbs
	));
?>
