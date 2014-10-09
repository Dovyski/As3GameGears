<?php
	require_once dirname(__FILE__).'/layout.php';

	$aData 				= View::data();
	$aText 				= $aData['text'];
	$aAuthor			= $aData['author'];

	layoutHeader('Start', View::baseUrl());

	echo '<div class="jumbotron item-jumbotron">';
		echo '<div class="container-fluid">';
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div id="headline" class="col-md-10">';
						if(!$aText) {
							echo '<i class="fa fa-exclamation-triangle fa-2x"></i>';
						}
						echo '<h2>'.($aText ? $aText['title'] : 'Not found').'</h2>';
					echo '</div>';
					echo '<div class="col-md-2">'.$aAuthor['display_name'].' <img src="http://avatars.io/twitter/'.$aAuthor['display_name'].'?size=medium" class="img-thumbnail" /></div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	if($aText) {
		//layoutBreadcrumbs($aData['breadcrumbs']);

		echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="col-md-12">';
					if($aData['editMode']) {
						layoutPrintMarkdownTextarea('test', $aText['content']);
					} else {
						echo MarkdownExtended($aText['content']);
					}
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}

	layoutFooter(View::baseUrl());
?>
