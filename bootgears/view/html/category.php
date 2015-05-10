<?php
	require_once dirname(__FILE__).'/layout.php';

	$aData 				= View::data();
	$aCategories 		= $aData['categories'];
	$aCategory 			= $aData['category'];
	$aItems 			= $aData['items'];
	$aLicenses 			= $aData['licenses'];
	$aPage				= $aData['page'];
	$aPages				= $aData['pages'];
	$aCurrentURL		= $aData['currentURL'];

	layoutHeader('Start', View::baseUrl());

	echo '<div class="jumbotron">';
		echo '<div class="container-fluid">';
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div id="headline">';
						echo '<i class="fa fa-gear fa-5x"></i>';
						echo '<h2>'.$aData['title'].'</h2>';
						echo '<p>'.$aData['subtitle'].'</p>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	layoutBreadcrumbs($aData['breadcrumbs']);

	if(count($aItems) > 0) {
		echo '<div class="container">';
			echo '<div class="row">';
				foreach($aItems as $aId => $aItem) {
					echo '<div class="col-md-4">';
						echo '<div class="panel panel-default item-descriptor">';
							// TODO: use something like utils::url() to expand those links using parent info...
							echo '<div class="panel-heading"><a href="/'.@$aCategories[$aItem['category']]['slug'].'/'.$aItem['name'].'">'.$aItem['name'].'</a></div>';
							echo '<div class="panel-body">';
								echo $aItem['excerpt'];
							echo '</div>';
							echo '<ul class="list-group">';
								echo '<li class="list-group-item">';
									if (isset($aItem['category'])) echo ($aData['showCategoryInItems'] ? '<a href="/category/'.$aItem['slug'].'"><i class="fa fa-folder"></i> '.@$aCategories[$aItem['category']]['name'].'</a>' : '&nbsp;');

									echo '<span class="pull-right">';
										if (isset($aItem['license'])) echo ' <a href="/license/'.$aLicenses[$aItem['license']]['slug'].'"><i class="fa fa-book"></i> '.$aLicenses[$aItem['license']]['name'].'</a>';
										if (isset($aItem['license2'])) echo ', <a href="/license/'.$aLicenses[$aItem['license2']]['slug'].'" class="pull-right"> '.$aLicenses[$aItem['license2']]['name'].'</a>';
									echo '</span>';
								echo '</li>';
							echo '</ul>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

			if($aPages > 1) {
				echo '<div class="row">';
					echo '<div class="col-md-12 text-center">';
						echo '<nav>';
							echo '<ul class="pagination">';
								for($i = 0; $i < $aPages; $i++) {
									$aIndex = $i + 1;

									if($aPage == $aIndex || ($i == 0 && $aPage <= 1)) {
										echo '<li class="active"><a href="javascript:void(0);">'.$aIndex.'</a></li>';
									} else {
										$aURL = $aIndex <= 1 ? $aCurrentURL : $aCurrentURL.'/page/'.$aIndex;
										echo '<li><a href="/'.$aURL.'">'.$aIndex.'</a></li>';
									}
								}
							echo '</ul>';
						echo '</nav>';
					echo '</div>';
				echo '</div>';
			}

		echo '</div>';
	}

	layoutPrintCategoryList($aCategories, $aData['categoriesPerColumn'], $aData['showCategoryDescription']);

	layoutFooter(View::baseUrl());
?>
