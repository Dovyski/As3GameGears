<!-- As3GameGears Sideinfo -->
<?php
	echo '<div id="widget-as3gg-sideinfo">';
		echo '<img src="'; bloginfo('template_directory'); echo '/images/sideinfo/sideinfo_splash.png" />';
		echo '<div>';
			echo '<img src="'; bloginfo('template_directory'); echo '/images/sideinfo/sideinfo_cube.png" />';
			echo '<p><strong>'.$infos['as3gg_license'].'</strong><br />License</p>';
			
			if(isset($infos['as3gg_site']) && $infos['as3gg_site'] != '') {
				echo '<img src="'; bloginfo('template_directory'); echo '/images/sideinfo/sideinfo_web.png" />';
				echo '<p><strong>'.$infos['as3gg_site'].'</strong><br />website</p>';
			}
			
			if(isset($infos['as3gg_twitter']) && $infos['as3gg_twitter'] != '') {
				echo '<img src="'; bloginfo('template_directory'); echo '/images/sideinfo/sideinfo_twitter.png" />';
				echo '<p><strong>'.$infos['as3gg_twitter'].'</strong><br />Twitter</p>';				
			}
			
			if(isset($infos['as3gg_repo']) && $infos['as3gg_repo'] != '') {
				echo '<img src="'; bloginfo('template_directory'); echo '/images/sideinfo/sideinfo_box.png" />';
				echo '<p><strong>'.$infos['as3gg_repo'].'</strong><br />Code repository</p>';				
			}
			
			if(isset($infos['as3gg_stats']) && $infos['as3gg_stats'] != '') {
				echo '<img src="'; bloginfo('template_directory'); echo '/images/sideinfo/sideinfo_stats.png" />';
				echo '<p><img src="http://www.ohloh.net/p/'.$infos['as3gg_stats'].'/analyses/latest/commits_spark.png" width="140" /></p>';				
			}
		echo '</div>';
	echo '</div>';
?>
<!-- /As3GameGears Sideinfo -->