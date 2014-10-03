<?php

function layoutNavBar($theBaseUrl) {
	$aPage = basename($_SERVER['PHP_SELF']);

	echo '<nav class="navbar navbar-default" role="navigation">';
		echo '<div class="container">';
			echo '<div class="navbar-header">';
				echo '<a class="navbar-brand" href="#"><img src="'.$theBaseUrl.'/img/as3gamegears_logo_full.png"/></a>';
			echo '</div>';

			echo '<div class="collapse navbar-collapse">';
					echo '<ul class="nav navbar-nav">';
						echo '<li '.($aPage == 'challenges.php' 	? 'class="active"' : '').'<li class="active"><a href="#">Blog</a></li>';
						echo '<li '.($aPage == 'challenges.php' 	? 'class="active"' : '').'<li><a href="#">Tools</a></li>';
						echo '<li '.($aPage == 'challenges.php' 	? 'class="active"' : '').'<li><a href="#">Assets</a></li>';
						echo '<li '.($aPage == 'challenges.php' 	? 'class="active"' : '').'<li><a href="#">Tutorials</a></li>';
						echo '<li '.($aPage == 'challenges.php' 	? 'class="active"' : '').'<li><a href="#">About</a></li>';
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

		echo '<script src="'.$theBaseUrl.'/js/jquery.js'.$aRandURLs.'"></script>';
		echo '<script src="'.$theBaseUrl.'/js/bootstrap.js'.$aRandURLs.'"></script>';
	echo '</head>';

	echo '<body>';

	layoutNavBar($theBaseUrl);
}

function layoutFooter($theBaseUrl = '.') {
		echo '<footer>';
			echo '<div class="container-fluid">';
				echo '<div class="row">';
					echo '<div class="col-md-1"></div>';
					echo '<div class="col-md-3">';
						echo '<h4>Licenses</h4>';
						echo '<p>AGPL3 Apache 2.0 Boost BSD CC-BY-SA 3.0 CC0 1.0 CC BY-NC-SA 3.0 CC BY 3.0 Commercial Free Free BSD GPL GPL2 GPL3 LGPL LGPL2 LGPL2.1 LGPL3 MIT Mozilla Public 1.1 Mozilla Public 2.0 Ms-PL New BSD Public Domain Simplified BSD WTFPL zlib</p>';
					echo '</div>';
					echo '<div class="col-md-1"></div>';
					echo '<div class="col-md-2 social-links">';
						echo '<h4>Follow us!</h4>';
						echo '<li><i class="fa fa-twitter"></i> Twitter</li>';
						echo '<li><i class="fa fa-google-plus"></i> Google+</li>';
						echo '<li><i class="fa fa-facebook"></i> Facebook</li>';
						echo '<li><i class="fa fa-rss"></i> RSS</li>';
					echo '</div>';
					echo '<div class="col-md-2">';
						echo '<h4>More links</h4>';
						echo '<li>About</li>';
						echo '<li>Disclaimer</li>';
						echo '<li>Extras</li>';
						echo '<li>As3GameGears API</li>';
						echo '<li>Brain Rating for Games</li>';
					echo '</div>';
					echo '<div class="col-md-2">';
						echo '<p>Play my games:</p>';
						echo '<img class="img-rounded" src="http://www.as3gamegears.com/wp-content/uploads/2013/05/180x100xpromo_mac_180_120.png.pagespeed.ic.GN1DrWupvM.jpg" width="180" height="120" alt="Madly Angry Cat" title="Madly Angry Cat" border="0">';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</footer>';

	echo '</body>';
	echo '</html>';
}


function layoutPrintCategoryList($theCategories, $theColumns = 3, $theBaseUrl = '.') {
	echo '<div class="container">';
		echo '<div class="row  text-center" style="padding: 40px 0 30px 0;">';
			echo '<div class="col-md-12">';
				echo '<hr><h4 style="margin-top: -30px;">Categories</h4></hr>';
			echo '</div>';
		echo '</div>';
		echo '<div class="row">';
			$aTotal = count($theCategories);
			$aAmountPerColumn = (int)($aTotal / $theColumns);

			$j = 0;
			$aCount = 0;
			foreach($theCategories as $aId => $aCategory) {
				if($aCategory['parent'] != 0) continue;

				if($j == 0 || $j >= $aAmountPerColumn) {
					if($aCount != 0) {
						echo '</div>';
					}
					if($aCount < $aTotal) {
						echo '<div class="col-md-'.((int)(12 / $theColumns)).'">';
					}

					$j = 0;
				}

				echo '<p><i class="fa fa-angle-right"></i> '.$aCategory['name'].'</p>';
				$j++;
				$aCount++;
			}
			// Close the last col
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

?>
