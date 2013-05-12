<!-- As3GameGears Sideinfo -->
<?php
	// Tip from: http://codex.wordpress.org/Function_Reference/plugin_basename
	$baseUrl = WP_PLUGIN_URL . '/'. PLUGIN_SLUG;

	echo '<div id="widget-as3gg-sideinfo">';
		if(!empty($infos['as3gg_spash'])) {
			echo '<img src="'. $baseUrl.'/images/'.$infos['as3gg_spash'].'" title="Information" />';			
		}
		echo '<div>';
			if(isset($infos['as3gg_download']) && $infos['as3gg_download'] != '') {
				echo '<a href="'.$infos['as3gg_download'].'" target="_blank" class="large yellow awesome" style="margin-bottom: 10px;">';
						echo '<img src="'. $baseUrl.'/images/sideinfo_download.png" border="0" />';
						echo 'Download<br /><small>Gimme it!</small>';
				echo '</a>';
			}
			
			if(isset($infos['as3gg_hide_license']) && $infos['as3gg_hide_license'] == false) {
				echo '<img src="'. $baseUrl.'/images/sideinfo_cube.jpg" />';
				echo '<p><strong>'.$infos['as3gg_license'].'</strong><br />License</p>';
			}
			
			if(isset($infos['as3gg_site']) && $infos['as3gg_site'] != '') {
				echo '<img src="'. $baseUrl.'/images/sideinfo_web.jpg" />';
				echo '<p><strong>'.$infos['as3gg_site'].'</strong><br />Website</p>';
			}
			
			if(isset($infos['as3gg_twitter']) && $infos['as3gg_twitter'] != '') {
				//echo '<img src="'. $baseUrl.'/images/sideinfo_twitter.jpg" />';
				echo '<img src="http://avatars.io/twitter/'. $raw_infos['as3gg_twitter'][0].'" width="36" height="36" style="margin: 0 5px 0 5px; border: 1px solid #a0a0a0;" />';
				echo '<p><strong>'.$infos['as3gg_twitter'].'</strong><br />Twitter</p>';				
			}
			
			if(isset($infos['as3gg_repo']) && $infos['as3gg_repo'] != '') {
				echo '<img src="'. $baseUrl.'/images/sideinfo_box.jpg" />';
				echo '<p><strong>'.$infos['as3gg_repo'].'</strong><br />Code Repository</p>';				
			}
			
			if(isset($infos['as3gg_stats']) && $infos['as3gg_stats'] != '') {
				echo '<p><img src="http://www.ohloh.net/p/'.$infos['as3gg_stats'].'/analyses/latest/commits_spark.png" width="179" height="32" /></p>';				
			}
			
			if (isset($infos['social_code']) && $infos['social_code'] != '') {
				echo $infos['social_code'];
			}
		echo '</div>';
	echo '</div>';
?>
<!-- /As3GameGears Sideinfo -->