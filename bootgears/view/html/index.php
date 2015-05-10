<?php
	require_once dirname(__FILE__).'/layout.php';

	$aData 			= View::data();
	$aCategories 	= $aData['categories'];

	layoutHeader('Start', View::baseUrl());

	echo '<div class="jumbotron">';
		echo '<div class="container-fluid">';
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div id="headline" class="col-md-12">';
						echo '<i class="fa fa-gear fa-5x"></i>';
						echo '<p>AS3 Game Gears is the right place to find tools, libraries and engines to build your game. There is no need to reinvent the wheel for every new Flash game you create, all you need is a place to search for the tools that best fit your needs.</p>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	echo '<div class="container">';
		echo '<div class="row text-center">';
			echo '<div class="col-md-4">';
				echo '<p><a href="/license/mit"><i class="fa fa-code fa-5x index-icon"></i></a></p>';
				echo '<h3><a href="/license/mit">Free Code</a></h3>';
				echo '<p>I know how to code, but I&#8217;m broke! Gimme all the free stuff you have.</p>';
			echo '</div>';
			echo '<div class="col-md-4">';
				echo '<p><a href="/license/commercial"><i class="fa fa-money fa-5x index-icon"></i></a></p>';
				echo '<h3><a href="/license/commercial">Commercial tools</a></h3>';
				echo '<p>I have money to spend. Show me the commercial solutions and tools!</p>';
		echo '</div>';
			echo '<div class="col-md-4">';
				echo '<p><a href="/category/assets"><i class="fa fa-photo fa-5x index-icon"></i></a></p>';
				echo '<h3><a href="/category/assets">Free Assets</a></h3>';
				echo '<p>I can code, but I have no art. I need assets to make my game!</p>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	layoutPrintCategoryList($aCategories, 4);

	layoutFooter(View::baseUrl());
?>
