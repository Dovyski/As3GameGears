<?php
	require_once dirname(__FILE__).'/layout.php';

	$aData 			= View::data();
	$aItem 			= $aData['item'];
	$aCategories 	= $aData['categories'];
	$aEditMode		= $aData['editMode'];

	layoutHeader('Start', View::baseUrl());

	echo '<div class="jumbotron item-jumbotron">';
		echo '<div class="container-fluid">';
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div id="headline">';
						if(!$aItem) {
							echo '<i class="fa fa-exclamation-triangle fa-2x"></i>';
						}
						if(!$aEditMode) {
							echo '<h2>'.($aItem ? $aItem['name'] : 'Not found').'</h2>';
						} else {
							echo '<input name="name" value="'.@$aItem['name'].'" class="form-control editable" />';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	if ($aItem) {
		if ($aData['showEditOption']) {
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="col-md-2 col-md-offset-10 text-right">';
						if ($aEditMode) {
							layoutPrintEditPanel($aItem['id'], 'item');
						} else { 
							echo '<a href="item.php?id='.$aItem['id'].'&edit=1"><i class="fa fa-edit"></i> Edit</a>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
	
		layoutBreadcrumbs($aData['breadcrumbs']);

		echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="col-md-12">';
					echo '<div class="item-meta">';
						echo '<div>';
								echo '<img src="http://avatars.io/twitter/'.$aItem['twitter'].'" width="36" height="36">';
								echo '<p><strong>'.($aEditMode ? '<input name="twitter" value="'.@$aItem['twitter'].'" class="editable" />' : $aData['developer']).'</strong> <br/>Developer</p>';
						echo '</div>';
						
						echo '<div>';
								echo '<i class="fa fa-book fa-3x"></i>';
								echo '<p><strong>';
									if(!$aEditMode) {
										echo ($aData['license'] ? $aData['license'] : 'Unknown');
									} else {
										$i = 0;
										do {
											$aKey = $i == 1 ? '2' : '';
											echo '<select name="license'.$aKey.'" class="editable">';
												echo '<option value=""></option>';
												foreach($aData['licenses'] as $aIdLicense => $aLicense) {
													echo '<option value="'.$aIdLicense.'" '.($aIdLicense == $aItem['license' . $aKey] ? 'selected="selected" ': '').'>'.$aLicense['name'].'</option>';
												}
											echo '</select><br/>';
										} while (++$i < 2);
									}
								echo '</strong><br/>License</p>';
						echo '</div>';
						
						echo '<div>';
								echo '<i class="fa fa-link fa-3x"></i>';
								echo '<p><strong>'.($aEditMode ? '<input name="site" value="'.@$aItem['site'].'" class="editable" />' : $aData['site']).'</strong> <br/>Website</p>';
						echo '</div>';
						
						if($aEditMode || isset($aData['repository']['url']) && $aData['repository']['url'] != '') {
							echo '<div>';
									echo '<i class="fa fa-'.@$aData['repository']['icon'].' fa-3x"></i>';
									echo '<p><strong>'.($aEditMode ? '<input name="repository" value="'.@$aItem['repository'].'" class="editable" />' : @$aData['repository']['url']).'</strong> <br/>Code Repository</p>';
							echo '</div>';
						}
						
						if($aEditMode || $aItem['stats']) {
							echo '<div>';
									if(!$aEditMode) {
										echo '<img src="http://www.ohloh.net/p/'.@$aItem['stats'].'/analyses/latest/commits_spark.png" width="179" height="34">';
									} else {
										echo '<p><strong>'.($aEditMode ? '<input name="stats" value="'.@$aItem['stats'].'" class="editable" />' : @$aItem['stats']).'</strong> <br/>Stats</p>';
									}
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
					if($aEditMode) {
						layoutPrintMarkdownTextarea('description', $aItem['description']);
					} else {
						echo MarkdownExtended($aItem['description']);
					}
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
