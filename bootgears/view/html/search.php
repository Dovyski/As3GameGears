<?php
	require_once dirname(__FILE__).'/layout.php';

	$aData 				= View::data();
	$aQuery 			= $aData['query'];
	$aPage 				= $aData['page'];
	$aItems 			= $aData['items'];
	$aCategories 		= $aData['categories'];
	$aLicenses 			= $aData['licenses'];

	layoutHeader('Search results', View::baseUrl());

	echo '<div class="jumbotron">';
		echo '<div class="container-fluid">';
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div id="headline">';
						echo '<i class="fa fa-gear fa-5x"></i>';
						echo '<h2>Search</h2>';
						echo '<p>Looking for "???"</p>';
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
									if (isset($aItem['category'])) echo '<a href="/category/'.@$aCategories[$aItem['category']]['slug'].'"><i class="fa fa-folder"></i> '.@$aCategories[$aItem['category']]['name'].'</a>';
									
									echo '<span class="pull-right">';
										if (isset($aItem['license'])) echo ' <a href="/search?license='.$aItem['license'].'"><i class="fa fa-book"></i> '.$aLicenses[$aItem['license']]['name'].'</a>';
										if (isset($aItem['license2'])) echo ', <a href="/search?license='.$aItem['license2'].'" class="pull-right"> '.$aLicenses[$aItem['license2']]['name'].'</a>';
									echo '</span>';
								echo '</li>';
							echo '</ul>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';
		echo '</div>';
	}

	layoutPrintCategoryList($aCategories, 4);

	layoutFooter(View::baseUrl());
?>
