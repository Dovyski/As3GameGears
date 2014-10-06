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
					if(!$aItem) {
						echo '<i class="fa fa-exclamation-triangle fa-2x"></i>';
					}
					echo '<h2>'.($aItem ? $aItem['name'] : 'Not found').'</h2>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	if($aItem) {
		layoutBreadcrumbs($aData['breadcrumbs']);

		echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="col-md-12">';
					echo '<div class="item-meta">';
						echo '<div>';
								echo '<img src="http://avatars.io/twitter/'.$aItem['twitter'].'" width="36" height="36">';
								echo '<p><strong>'.$aData['developer'].'</strong> <br/>Developer</p>';
						echo '</div>';
						echo '<div>';
								echo '<i class="fa fa-book fa-3x"></i>';
								echo '<p><strong>'.($aData['license'] ? $aData['license'] : 'Unknown').'</strong><br/>License</p>';
						echo '</div>';
						echo '<div>';
								echo '<i class="fa fa-link fa-3x"></i>';
								echo '<p><strong>'.$aData['site'].'</strong> <br/>Website</p>';
						echo '</div>';
						if($aData['repository']['url'] != '') {
							echo '<div>';
									echo '<i class="fa fa-'.$aData['repository']['icon'].' fa-3x"></i>';
									echo '<p><strong>'.$aData['repository']['url'].'</strong> <br/>Code Repository</p>';
							echo '</div>';
						}
						if($aItem['stats']) {
							echo '<div>';
									echo '<img src="http://www.ohloh.net/p/'.$aItem['stats'].'/analyses/latest/commits_spark.png" width="179" height="34">';
							echo '</div>';
						}

						if($aData['social_repo']) {
							echo '<div>';
									echo $aData['social_repo'];
							echo '</div>';
						}
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
	}

	layoutPrintCategoryList($aCategories, 4);

	echo '<!-- Code highlight -->';
	echo '<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.2/styles/default.min.css">';
	echo '<script src="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.2/highlight.min.js"></script>';

	echo '<script>hljs.initHighlightingOnLoad();</script>';
	echo "<script>
			hljs.tabReplace='  ';
			$(document).ready(function(){
				$('pre').each(function(i,e){
					hljs.highlightBlock(e);
				});
			});
			</script>
	</script>";

	layoutFooter(View::baseUrl());
?>
