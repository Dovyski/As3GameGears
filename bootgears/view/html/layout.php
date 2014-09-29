<?php

function layoutNavBar($theBaseUrl) {
	$aPage = basename($_SERVER['PHP_SELF']);

	echo '<nav class="navbar navbar-default" role="navigation">';
		echo '<div class="container">';
			echo '<div class="navbar-header">';
				echo '<a class="navbar-brand" href="index.php" title="Ir para página inicial"><i class="fa fa-home"/></i></a>';
			echo '</div>';

			echo '<div class="collapse navbar-collapse">';
					echo '<ul class="nav navbar-nav">';
						echo '<li '.($aPage == 'challenges.php' 	? 'class="active"' : '').'><a href="challenges.php">Desafios</a></li>';
						echo '<li '.($aPage == 'assignments.php' 	? 'class="active"' : '').'><a href="assignments.php">Trabalhos '.($aAssignmentCount != 0 ? '<span class="badge alert-danger">'.$aAssignmentCount.'</span>' : '').'</a></li>';
					echo '</ul>';
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
		echo '<link href="'.$theBaseUrl.'/css/style.css'.$aRandURLs.'" rel="stylesheet">';

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
		echo '<div class="container">';
			echo '<hr>';
			echo '<footer class="footer">';
				echo '<a href="http://fronteiratec.com" target="_blank"><img src="'.$theBaseUrl.'/img/logo_fronteiratec_small.png"/></a>';
				echo '<a href="http://cc.uffs.edu.br" target="_blank"><img src="'.$theBaseUrl.'/img/logo_cc_bw.png"/></a>';
				echo '<p>&copy; '.date('Y').' - FronteiraTec - Todos os direitos reservados.</p>';
			echo '</footer>';

			echo '<div id="info-overlay">Salvando...</div>';

		if(DEBUG_MODE) {
			echo '<div class="row" style="margin-top: 80px;">';
				echo '<div class="span12">';
					echo '<h2>Debug</h2>';
					echo 'IP <pre>'.$_SERVER['REMOTE_ADDR'].'</pre>';
					echo 'Sessão ';
					var_dump($_SESSION);
				echo '</div>';
			echo '</div>';
		}
		echo '</div>';

	echo '</body>';
	echo '</html>';
}

?>
