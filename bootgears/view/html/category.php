<?php
	require_once dirname(__FILE__).'/layout.php';

	layoutHeader('Start', View::baseUrl());

	echo '<div class="jumbotron">';
		echo '<div class="container-fluid">';
			echo '<div class="row">';
				echo '<div id="headline" class="center-block">';
					echo '<i class="fa fa-gear fa-5x"></i>';
					echo '<h2>Air Native Extension</h2>';
					echo '<p>Extend the Flash API and leverage the power of platform native features.</p>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="col-md-12">';
				echo '<ol class="breadcrumb">';
					echo '<li><a href="#">Home</a></li>';
					echo '<li class="active"><a href="#">Air Native Extension</a></li>';
				echo '</ol>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="col-sm-6 col-md-4">';
				echo '<div class="thumbnail item-descriptor">';
					echo '<div class="caption">';
						echo '<h3>Rating</h3>';
						echo '<p>Native extension to handle the process of rating an application. It has a set of methods that can be combined to allow developers to collect and…</p>';
						echo '<p>';
							echo '<a href="#" class="btn btn-default"><i class="fa fa-folder"></i> ANE</a></li> ';
							echo '<a href="#" class="btn btn-default"><i class="fa fa-book"></i> MIT</a></li>';
						echo '</p>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	echo '<div class="container">';
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
