<?php
	require_once dirname(__FILE__).'/layout.php';

	layoutHeader('Start', View::baseUrl());

	echo '<div class="jumbotron">';
		echo '<div class="container-fluid">';
			echo '<div class="row">';
				echo '<div id="headline" class="center-block">';
					echo '<i class="fa fa-gear fa-5x"></i>';
					echo '<p>AS3 Game Gears is the right place to find tools, libraries and engines to build your game. There is no need to reinvent the wheel for every new Flash game you create, all you need is a place to search for the tools that best fit your needs.</p>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	echo '<div class="container">';
		echo '<div class="row text-center">';
			echo '<div class="col-md-4">';
				echo '<p><i class="fa fa-code fa-5x"></i></p>';
				echo '<h3>Free Code</h3>';
				echo '<p>I know how to code, but I&#8217;m broke! Gimme all the free stuff you have.</p>';
			echo '</div>';
			echo '<div class="col-md-4">';
				echo '<p><i class="fa fa-money fa-5x"></i></p>';
				echo '<h3>Commercial tools</h3>';
				echo '<p>I have money to spend. Show me the commercial solutions and tools!</p>';
		echo '</div>';
			echo '<div class="col-md-4">';
				echo '<p><i class="fa fa-photo fa-5x"></i></p>';
				echo '<h3>Free Assets</h3>';
				echo '<p>I can code, but I have no art. I need assets to make my game!</p>';
			echo '</div>';
		echo '</div>';

		echo '<div class="row  text-center" style="padding: 40px 0 30px 0;">';
			echo '<div class="col-md-12">';
				echo '<hr><h4 style="margin-top: -30px;">Categories</h4></hr>';
			echo '</div>';
		echo '</div>';

		echo '<div class="row">';
			echo '<div class="col-md-3">';
				echo '<p><i class="fa fa-angle-right"></i> Air Native Extension</p>';
				echo '<p><i class="fa fa-angle-right"></i> Animation</p>';
				echo '<p><i class="fa fa-angle-right"></i> Augmented Reality</p>';
				echo '<p><i class="fa fa-angle-right"></i> Authentication</p>';
				echo '<p><i class="fa fa-angle-right"></i> Backend</p>';
				echo '<p><i class="fa fa-angle-right"></i> Compression</p>';
				echo '<p><i class="fa fa-angle-right"></i> Air Native Extension</p>';
				echo '<p><i class="fa fa-angle-right"></i> Animation</p>';
				echo '<p><i class="fa fa-angle-right"></i> Augmented Reality</p>';
				echo '<p><i class="fa fa-angle-right"></i> Authentication</p>';
			echo '</div>';

			echo '<div class="col-md-3">';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Air Native Extension</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Animation</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Augmented Reality</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Authentication</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Backend</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Compression</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Air Native Extension</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Animation</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Augmented Reality</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Authentication</p>';
			echo '</div>';

			echo '<div class="col-md-3">';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Air Native Extension</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Animation</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Augmented Reality</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Authentication</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Backend</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Compression</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Air Native Extension</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Animation</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Augmented Reality</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Authentication</p>';
			echo '</div>';

			echo '<div class="col-md-3">';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Air Native Extension</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Animation</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Augmented Reality</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Authentication</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Backend</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Compression</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Air Native Extension</p>';
				echo '<p><span class="glyphicon glyphicon-chevron-right"></span> Animation</p>';
			echo '</div>';
		echo '</div>';
	echo '</div> <!-- /container -->';

	layoutFooter(View::baseUrl());
?>
