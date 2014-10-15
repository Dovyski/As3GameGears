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

	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="col-md-12">';
				echo '<p>Apologies, but the page you requested could not be found. Some of the reasons for that:

Cookie (dog in the picture) ate the page;
An alien army vaporized it;
The page is shy;
You already unlocked that achievement;
The page uses a negative FPS rate to be rendered;
The page did not make the deadline, so it was left out;
The page is a plugin, but you live in a plugin-free universe;
Apple is still reviewing the page and asking for changes before it can be published;
The page is still being hammered by Steam\'s Green Light commenters;
The page was exchanged by some game assets;</p>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
	
	layoutFooter(View::baseUrl());
?>
