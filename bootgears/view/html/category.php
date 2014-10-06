<?php
	require_once dirname(__FILE__).'/layout.php';

	$aData 				= View::data();
	$aCategories 	= $aData['categories'];
	$aCategory 		= $aData['category'];
	$aItems 			= $aData['items'];

	layoutHeader('Start', View::baseUrl());

	echo '<div class="jumbotron">';
		echo '<div class="container-fluid">';
			echo '<div class="row">';
				echo '<div id="headline" class="center-block">';
					echo '<i class="fa fa-gear fa-5x"></i>';
					echo '<h2>'.$aCategory['name'].'</h2>';
					echo '<p>'.$aCategory['description'].'</p>';
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
						echo '<div class="thumbnail item-descriptor">';
							echo '<div class="caption">';
								echo '<h3><a href="item.php?id='.$aItem['id'].'">'.$aItem['name'].'</a></h3>';
								echo '<p>'.$aItem['excerpt'].'</p>';
								echo '<p>';
									echo '<a href="#" class="btn btn-default"><i class="fa fa-folder"></i> ANE</a></li> ';
									echo '<a href="#" class="btn btn-default"><i class="fa fa-book"></i> MIT</a></li>';
								echo '</p>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';
		echo '</div>';
	}

	layoutPrintCategoryList($aCategories, 4);

	layoutFooter(View::baseUrl());
?>
