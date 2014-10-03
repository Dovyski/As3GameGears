<?php
	require_once dirname(__FILE__).'/layout.php';

	$aData 				= View::data();
	$aItem 				= $aData['item'];
	$aCategories 	= $aData['categories'];

	layoutHeader('Start', View::baseUrl());

	echo '<div class="jumbotron item-jumbotron">';
		echo '<div class="container-fluid">';
			echo '<div class="row">';
				echo '<div id="headline" class="center-block">';
					echo '<h2>'.$aItem['name'].'</h2>';
					echo '<p>'.$aItem['category'].'</p>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	// Breadcrumbs
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
			echo '<div class="col-md-12">';
				echo '<div class="item-meta">';
					echo '<div>';
							echo '<img src="http://avatars.io/twitter/'.$aItem['twitter'].'" width="36" height="36">';
							echo '<p><strong>'.$aItem['twitter'].'</strong> <br/>Developer</p>';
					echo '</div>';
					echo '<div>';
							echo '<i class="fa fa-book fa-3x"></i>';
							echo '<p><strong>'.$aItem['license'].'</strong><br/>License</p>';
					echo '</div>';
					echo '<div>';
							echo '<i class="fa fa-link fa-3x"></i>';
							echo '<p><strong>github.com/digic...</strong> <br/>Website</p>';
					echo '</div>';
					echo '<div>';
							echo '<i class="fa fa-github fa-3x"></i>';
							echo '<p><strong>Github</strong> <br/>Code Repository</p>';
					echo '</div>';
					echo '<div>';
							echo '<img src="http://www.ohloh.net/p/flixel/analyses/latest/commits_spark.png" width="179" height="32">';
					echo '</div>';
					echo '<div>';
							//echo '<iframe src="http://ghbtns.com/github-btn.html?user=digicrafts&repo=Rating-ANE&type=watch&count=true&size=small" allowtransparency="true" frameborder="0" scrolling="0" style="border: 0; width: 100px; height: 30px; overflow: hidden; margin-top: 10px;"></iframe>';
							//echo '<iframe src="http://ghbtns.com/github-btn.html?user=digicrafts&repo=Rating-ANE&type=fork&count=true&size=small" allowtransparency="true" frameborder="0" scrolling="0" style="border: 0; width: 100px; height: 30px; overflow: hidden; margin-top: 10px;"></iframe>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="col-md-12">';
				echo '<p>'.str_replace("\n", '</p><p>', $aItem['description']).'</p>';
			echo '</div>';

			if($aItem['sample']) {
				echo '<div class="col-md-12">';
					echo '<p><strong>Sample</strong></p>';
					echo '<pre class="brush: as3">';
						echo $aItem['sample'];
					echo '</pre>';
				echo '</div>';
			}
		echo '</div>';
	echo '</div>';

	layoutPrintCategoryList($aCategories, 4);

	echo '<!-- Code highlight -->';
	echo '<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.2/styles/default.min.css">';
	echo '<script src="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.2/highlight.min.js"></script>';

	echo '<script>hljs.initHighlightingOnLoad();</script>';
	echo "<script>
			hljs.tabReplace='  ';
			$(document).ready(function(){
				$('pre').each(function(i,e){
					hljs.highlightBlock(e)
				});
			});
			</script>
	</script>";

	layoutFooter(View::baseUrl());
?>
