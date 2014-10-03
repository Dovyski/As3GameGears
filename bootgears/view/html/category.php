<?php
	require_once dirname(__FILE__).'/layout.php';

	$aData 				= View::data();
	$aCategories 	= $aData['categories'];
	$aCategory 		= $aData['category'];

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

	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="col-md-12">';
				echo '<ol class="breadcrumb">';
					echo '<li><a href="#">Home</a></li>';
					echo '<li class="active"><a href="#">Air Native Extension</a></li>';
				echo '</ol>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="col-sm-6 col-md-4">';
				echo '<div class="thumbnail item-descriptor">';
					echo '<div class="caption">';
						echo '<h3>Rating</h3>';
						echo '<p>Native extension to handle the process of rating an application. It has a set of methods that can be combined to allow developers to collect and…</p>';
						echo '<p>';
							echo '<a href="#" class="btn btn-default"><i class="fa fa-folder"></i> ANE</a></li> ';
							echo '<a href="#" class="btn btn-default"><i class="fa fa-book"></i> MIT</a></li>';
						echo '</p>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	layoutPrintCategoryList($aCategories, 4);

	layoutFooter(View::baseUrl());
?>
