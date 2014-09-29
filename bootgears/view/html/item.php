<?php
	require_once dirname(__FILE__).'/layout.php';

	layoutHeader('Start', View::baseUrl());

	echo '<div class="jumbotron item-jumbotron">';
		echo '<div class="container-fluid">';
			echo '<div class="row">';
				echo '<div id="headline" class="center-block">';
					echo '<h2>Flixel</h2>';
					echo '<p>2D Game engine</p>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	// Breadcrumbs
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
			echo '<div class="col-md-12">';
				echo '<div class="item-meta">';
					echo '<div>';
							echo '<img src="http://avatars.io/twitter/digicrafts" width="36" height="36">';
							echo '<p><strong>digicrafts</strong> <br/>Developer</p>';
					echo '</div>';
					echo '<div>';
							echo '<i class="fa fa-book fa-3x"></i>';
							echo '<p><strong>BSD</strong><br/>License</p>';
					echo '</div>';
					echo '<div>';
							echo '<i class="fa fa-link fa-3x"></i>';
							echo '<p><strong>github.com/digic...</strong> <br/>Website</p>';
					echo '</div>';
					echo '<div>';
							echo '<i class="fa fa-github fa-3x"></i>';
							echo '<p><strong>Github</strong> <br/>Code Repository</p>';
					echo '</div>';
					echo '<div>';
							echo '<img src="http://www.ohloh.net/p/flixel/analyses/latest/commits_spark.png" width="179" height="32">';
					echo '</div>';
					echo '<div>';
							echo '<iframe src="http://ghbtns.com/github-btn.html?user=digicrafts&repo=Rating-ANE&type=watch&count=true&size=small" allowtransparency="true" frameborder="0" scrolling="0" style="border: 0; width: 100px; height: 30px; overflow: hidden; margin-top: 10px;"></iframe>';
							echo '<iframe src="http://ghbtns.com/github-btn.html?user=digicrafts&repo=Rating-ANE&type=fork&count=true&size=small" allowtransparency="true" frameborder="0" scrolling="0" style="border: 0; width: 100px; height: 30px; overflow: hidden; margin-top: 10px;"></iframe>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="col-md-12">';
				echo '<p>Rating is a native extension to handle the process of rating an application. It has a set of methods that can be combined to allow developers to collect and interpret some information before asking the user to rate the application, which might increase the chances of a positive rate. Regarding the available information, the extension provides a method to read how many times the application has been launched, how many uses per week and if the current version has been rated by the user, for instance.</p>';
				echo '<p>Regarding the rating process, the extension has a method to directly open the rating screen of the corresponding app store. Additionally it’s possible to define a period of time or a certain amount of launches to trigger the rating screen, among other options.</p>';
			echo '</div>';

			echo '<div class="col-md-12">';
				echo '<p><strong>Sample</strong></p>';
	echo '<pre class="brush: as3">';
	echo '// Call this when application launched';
	echo 'Rating.instance.applicationLaunched();';

	echo '// Two examples of rating use';
	echo 'Rating.promptIfNetworkAvailable();';
	echo 'Rating.openRatingsPage();';

	echo 'trace("Launches: " + Rating.usesCount);';

	echo '// Customize rating message';
	echo 'Rating.messageTitle = "Rate my app!";';
	echo 'Rating.message = "You like it, I know you do!";';

	echo '// Schedule prompt to trigger in 3 days and a half';
	echo 'Rating.daysUntilPrompt = 3.5;';
	echo '// If the user dont rate the app, remind him';
	echo '// after 7 days.';
	echo 'Rating.remindPeriod = 7;';
	echo '</pre>';
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

	echo '<!-- Code highlight -->';
	echo '<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.2/styles/default.min.css">';
	echo '<script src="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.2/highlight.min.js"></script>';

	echo '<script>hljs.initHighlightingOnLoad();</script>';
	echo "<script>
			hljs.tabReplace='  ';
			$(document).ready(function(){
				$('pre').each(function(i,e){
					hljs.highlightBlock(e)
				});
			});
			</script>
	</script>";

	layoutFooter(View::baseUrl());
?>
