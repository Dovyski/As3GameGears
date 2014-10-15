<?php
	require_once dirname(__FILE__).'/layout.php';

	$aData 				= View::data();
	$aText 				= $aData['text'];
	$aAuthor			= $aData['author'];
	$aEditMode			= $aData['editMode'];

	layoutHeader('Start', View::baseUrl());

	echo '<div class="jumbotron text-jumbotron">';
		echo '<div class="container-fluid">';
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div id="headline" class="col-md-8">';
						if(!$aText) {
							echo '<i class="fa fa-exclamation-triangle fa-2x"></i>';
						}
						if(!$aEditMode) {
							echo '<h2>'.($aText ? $aText['title'] : 'Not found').'</h2>';
						} else {
							echo '<input name="title" value="'.@$aText['title'].'" class="form-control editable" style="background: transparent; color: black; font-size: 2em; height: 40px; border: none;" />';
						}
					echo '</div>';
					echo '<div class="col-md-4 post-author">';
						echo '<a href="http://twitter.com/'.$aAuthor['display_name'].'" target="_blank"><img src = "http://avatars.io/twitter/'.$aAuthor['display_name'].'?size=medium" class="img-thumbnail" border="0" /></a>';
						echo '<p><strong><a href="http://twitter.com/'.$aAuthor['display_name'].'" target="_blank">'.$aAuthor['name'].'</a></strong><br/> on '.date('M d, Y').' </p>';
					echo '</div>';						
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	if ($aText) {
		if ($aData['showEditOption']) {
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="col-md-2 col-md-offset-10 text-right">';
						if ($aData['editMode']) {
							layoutPrintEditPanel($aText['id'], 'text');
						} else { 
							echo '<a href="text.php?id='.$aText['id'].'&edit=1"><i class="fa fa-edit"></i> Edit</a>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		layoutBreadcrumbs($aData['breadcrumbs']);

		echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="col-md-12">';
					if($aData['editMode']) {
						layoutPrintMarkdownTextarea('content', $aText['content']);
					} else {
						echo MarkdownExtended($aText['content']);
					}
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}

	layoutFooter(View::baseUrl());
?>
