<!-- As3GameGears Sideinfo -->
<?php 
	echo '<div id="widget-as3gg-project-info">';
		echo '<img src="'; bloginfo('template_directory'); echo '/images/sideinfo/sideinfo_splash.png" />';
		echo '<div>';
			echo '<img src="'; bloginfo('template_directory'); echo '/images/sideinfo/sideinfo_cube.png" />';
			echo '<p><strong>Mozilla Public 1.0</strong><br />License</p>';
			
			echo '<img src="'; bloginfo('template_directory'); echo '/images/sideinfo/sideinfo_web.png" />';
			echo '<p><strong>www.site.com.br</strong><br />website</p>';

			echo '<img src="'; bloginfo('template_directory'); echo '/images/sideinfo/sideinfo_twitter.png" />';
			echo '<p><strong>@twitteracount</strong><br />Twitter</p>';
			
			echo '<img src="'; bloginfo('template_directory'); echo '/images/sideinfo/sideinfo_box.png" />';
			echo '<p><strong>GitHub</strong><br />Code repository</p>';
			
			echo '<img src="'; bloginfo('template_directory'); echo '/images/sideinfo/sideinfo_stats.png" />';
			echo '<p><img src="http://www.ohloh.net/p/charack/analyses/latest/commits_spark.png" width="140" /></p>';
			
			echo '<br /><br />';
			
			//echo '<pre>';
			//print_r(get_post_meta(get_the_ID(), 'customkeytest', false));
			//echo '</pre>';
		echo '</div>';
	echo '</div>';
?>
<!-- /As3GameGears Sideinfo -->