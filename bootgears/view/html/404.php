<?php
	require_once dirname(__FILE__).'/layout.php';

	layoutHeader('Page not found', View::baseUrl());

	echo '<div class="jumbotron item-jumbotron">';
		echo '<div class="container-fluid">';
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div id="headline" class="col-md-12">';
						echo '<i class="fa fa-exclamation-triangle fa-2x"></i>';
						echo '<h2>Oops, not found!</h2>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	$aReasons = array(
		'Cookie (dog in the picture) ate the page.',
		'An alien army vaporized it.',
		'The page is shy.',
		'You already unlocked that achievement.',
		'The page uses a negative FPS rate to be rendered.',
		'The page did not make the deadline, so it was left out.',
		'The page is a plugin, but you live in a plugin-free universe.',
		'Apple is still reviewing the page and asking for changes before it can be published.',
		'The page is still being hammered by Steam Green Light commenters.',
		'The page was exchanged by some game assets.',
		'The page is procrastinating, it should be back soon.',
		'It is too dangerous to go alone, so the page has been used as a companion/weapon by someone.',
		'The page is a game about to be released, but it is not quite ready yet. Just a couple features are missing.',
	);
	
	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="col-md-12">';
				echo '<img src="'.View::baseUrl().'/img/404.jpg" title="Cookie" style="float:right; width: 350px; height: auto; marging-left: 35px;" class="thumbnail" />';
				echo '<p style="margin-top: 30px; margin-bottom: 30px;">Apologies, but the page you requested could not be found. A reason for that:</p>';
				echo '<blockquote><span id="reason">'.$aReasons[0].'</span> <i class="fa fa-circle-o-notch fa-spin"></i></blockquote>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
	
	echo "<script>
		var reasons = ['".implode("','", $aReasons)."'];
		setInterval(function() {
			var text = reasons[Math.floor(Math.random()*reasons.length)];
			$('#reason').fadeOut(function() {
				$(this).html(text).fadeIn();
			});
		}, 7000);
	</script>";
	
	layoutFooter(View::baseUrl());
?>
