<?php

function layoutNavBar($theBaseUrl) {
	$aPage = basename($_SERVER['PHP_SELF']);

	echo '<nav class="navbar navbar-default" role="navigation">';
		echo '<div class="container">';
			echo '<div class="navbar-header">';
				echo '<a class="navbar-brand" href="/"><img src="'.$theBaseUrl.'/img/as3gamegears_logo_full.png"/></a>';
			echo '</div>';

			echo '<div class="collapse navbar-collapse">';
					echo '<ul class="nav navbar-nav">';
						echo '<li '.($aPage == 'challenges.php' 	? 'class="active"' : '').'><a href="#">Blog</a></li>';
						echo '<li '.($aPage == 'category.php' 		? 'class="active"' : '').'><a href="category.php">Tools</a></li>';
						echo '<li '.($aPage == 'challenges.php' 	? 'class="active"' : '').'><a href="category.php?id=1">Assets</a></li>';
						echo '<li '.($aPage == 'challenges.php' 	? 'class="active"' : '').'><a href="category.php?id=1">Tutorials</a></li>';
						echo '<li '.($aPage == 'challenges.php' 	? 'class="active"' : '').'><a href="category.php?id=1">About</a></li>';
					echo '</ul>';
					echo '<form class="navbar-form navbar-right" role="search">';
						echo '<div class="form-group">';
							echo '<input type="text" class="form-control " placeholder="Search">';
						echo '</div>';
						echo '<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>';
					echo '</form>';
			echo '</div>';
		echo '</div>';
	echo '</nav>';
}

function layoutHeader($theTitle, $theBaseUrl = '.') {
	echo '<!DOCTYPE html>';
	echo '<html lang="en">';
	echo '<head>';
		echo '<meta charset="utf-8">';
		echo '<title>'.(empty($theTitle) ? '' : $theTitle).' | Codebot</title>';
		echo '<meta name="description" content="">';
		echo '<meta name="author" content="">';

		echo '<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->';
		echo '<!--[if lt IE 9]>';
		echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
		echo '<![endif]-->';

		$aRandURLs = DEBUG_MODE ? '?'.rand(20, 9999) : '';

		echo '<!-- Le styles -->';
		echo '<link href="'.$theBaseUrl.'/css/bootstrap.css" rel="stylesheet">';
		echo '<link href="'.$theBaseUrl.'/style.css'.$aRandURLs.'" rel="stylesheet">';

		echo '<!-- Le fav and touch icons -->';
		echo '<link rel="shortcut icon" href="img/favicon.ico">';
		echo '<link rel="apple-touch-icon" href="/img/apple-touch-icon.png">';
		echo '<link rel="apple-touch-icon" sizes="72x72" href="/img/apple-touch-icon-72x72.png">';
		echo '<link rel="apple-touch-icon" sizes="114x114" href="/img/apple-touch-icon-114x114.png">';

		echo '<!-- FontAwesome -->';
		echo '<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">';
		
		// TODO: move to page bottom
		echo '<script src="'.$theBaseUrl.'/js/jquery-1.11.1.min.js'.$aRandURLs.'"></script>';
		echo '<script src="'.$theBaseUrl.'/js/bootstrap.js'.$aRandURLs.'"></script>';
		echo '<script src="'.$theBaseUrl.'/js/app.js'.$aRandURLs.'"></script>';
	echo '</head>';

	echo '<body>';

	layoutNavBar($theBaseUrl);
}

function layoutFooter($theBaseUrl = '.') {
		echo '<footer>';
			echo '<div class="container-fluid">';
				echo '<div class="container">';
					echo '<div class="row">';
						echo '<div class="col-md-3 social-links">';
							echo '<h4>Follow us!</h4>';
							echo '<li><i class="fa fa-twitter"></i> <a href="http://twitter.com/As3GameGears" target="_blank">Twitter</a></li>';
							echo '<li><i class="fa fa-google-plus"></i> <a href="http://google.com/+As3GameGears" target="_blank">Google+</a></li>';
							echo '<li><i class="fa fa-facebook"></i> <a href="http://facebook.com/As3GameGears" target="_blank">Facebook</a></li>';
							echo '<li><i class="fa fa-rss"></i> <a href="/feed/" target="_blank">RSS</a></li>';
						echo '</div>';
						echo '<div class="col-md-3">';
							echo '<h4>More links</h4>';
							echo '<li><a href="">About</a></li>';
							echo '<li><a href="">Disclaimer</a></li>';
							echo '<li><a href="">Extras</a></li>';
							echo '<li><a href="">As3GameGears API</a></li>';
							echo '<li><a href="">Brain Rating for Games</a></li>';
						echo '</div>';
						echo '<div class="col-md-6">';
							echo '<p>Play my games:</p>';
							echo '<img class="img-rounded" src="http://www.as3gamegears.com/wp-content/uploads/2013/05/180x100xpromo_mac_180_120.png.pagespeed.ic.GN1DrWupvM.jpg" width="180" height="120" alt="Madly Angry Cat" title="Madly Angry Cat" border="0"> ';
							echo '<img class="img-rounded" src="http://www.as3gamegears.com/wp-content/uploads/2013/05/180x100xpromo_mac_180_120.png.pagespeed.ic.GN1DrWupvM.jpg" width="180" height="120" alt="Madly Angry Cat" title="Madly Angry Cat" border="0"> ';
							echo '<img class="img-rounded" src="http://www.as3gamegears.com/wp-content/uploads/2013/05/180x100xpromo_mac_180_120.png.pagespeed.ic.GN1DrWupvM.jpg" width="180" height="120" alt="Madly Angry Cat" title="Madly Angry Cat" border="0"> ';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</footer>';
		
	echo '</body>';
	echo '</html>';
}


function layoutPrintCategoryList($theCategories, $theColumns = 3, $theShowDescription = false, $theBaseUrl = '.') {
	echo '<div class="container">';
		if(!$theShowDescription) {
			echo '<div class="row  text-center" style="padding: 40px 0 30px 0;">';
				echo '<div class="col-md-12">';
					echo '<hr><h4 style="margin-top: -30px;">Categories</h4></hr>';
				echo '</div>';
			echo '</div>';
		}
		echo '<div class="row">';
			$aTotal = count($theCategories);
			$aAmountPerColumn = (int)($aTotal / $theColumns);

			$j = 0;
			$aCount = 0;
			foreach($theCategories as $aId => $aCategory) {
				//if($aCategory['parent'] != 0) continue;

				if($j == 0 || $j >= $aAmountPerColumn) {
					if($aCount != 0) {
						echo '</div>';
					}
					if($aCount < $aTotal) {
						echo '<div class="col-md-'.((int)(12 / $theColumns)).'">';
					}

					$j = 0;
				}

				echo '<p><i class="fa fa-'.($theShowDescription ? 'chevron-circle-right' : 'angle-right').'"></i> <a href="category.php?id='.$aCategory['id'].'">'.$aCategory['name'].'</a>'.($theShowDescription ? '<br/>'.$aCategory['description'] : '').'</p>';
				$j++;
				$aCount++;
			}
			// Close the last col
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function layoutBreadcrumbs($theData) {
	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="col-md-12">';
				echo '<ol class="breadcrumb">';
					echo '<li><a href="/index.php">Site</a></li>';
					echo '<li><a href="/category.php">Tools</a></li>';
					if(isset($theData) && count($theData)) {
						for($i = count($theData) - 1; $i >= 0; $i--) {
							$aEntry = $theData[$i];
							echo '<li class="active"><a href="'.$aEntry['link'].'">'.$aEntry['name'].'</a></li>';
						}
					}
				echo '</ol>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function layoutPrintMarkdownTextarea($theFieldName, $theInitialText = '', $theTabsText = array(), $theTextAreaHeight = '300px') {
	echo '<div class="tabbable markdown-panel">';
		echo '<ul class="nav nav-tabs">';
			echo '<li class="active"><a href="#'.$theFieldName.'-tab-markdown" data-toggle="tab">'.(isset($theTabsText[0]) ? $theTabsText[0] : 'Source').'</a></li>';
			echo '<li><a href="#'.$theFieldName.'-tab-view-markdown" data-toggle="tab">'.(isset($theTabsText[1]) ? $theTabsText[1] : 'View').'</a></li>';
		echo '</ul>';
		echo '<div class="tab-content" style="min-height: '.$theTextAreaHeight.'; width: 100%; overflow: auto;">';
			echo '<div class="tab-pane active" id="'.$theFieldName.'-tab-markdown">';
				echo '<textarea name="'.$theFieldName.'" id="'.$theFieldName.'" style="width: 100%; height: '.$theTextAreaHeight.'; border-top: none; padding-top: 5px" class="editable">'.$theInitialText.'</textarea>';
			echo '</div>';
			echo '<div class="tab-pane" id="'.$theFieldName.'-tab-view-markdown" style="padding: 7px 5px 5px 3px;">';
				echo 'A visualização não está disponível ainda. Desculpe!';
			echo '</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<script type="text/javascript">AS3GAMEGEARS.createMarkdownTextarea(\''.$theFieldName.'\');</script>';
}

function layoutPrintEditPanel($theEntryId, $theEntryType) {
	echo '<button onclick="AS3GAMEGEARS.saveEntry('.$theEntryId.', \''.$theEntryType.'\', this);" class="btn btn-default"><i class="fa fa-save"></i></button>';
}

?>
