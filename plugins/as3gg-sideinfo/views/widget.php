<!-- As3GameGears Sideinfo -->
<?php
	// Tip from: http://codex.wordpress.org/Function_Reference/plugin_basename
	$baseUrl = WP_PLUGIN_URL . '/'. PLUGIN_SLUG;

	echo '<div id="widget-as3gg-sideinfo">';
        echo '<h3>Information</h3>';

		if(!empty($infos['as3gg_spash'])) {
			//echo '<img src="'. $baseUrl.'/images/'.$infos['as3gg_spash'].'" title="Information" />';			
		}
		echo '<div>';
			if(isset($infos['as3gg_download']) && $infos['as3gg_download'] != '') {
				echo '<a href="'.$infos['as3gg_download'].'" target="_blank" class="large yellow awesome" style="margin-bottom: 10px;">';
						echo '<span><i class="fa fa-camera-retro fa-3x"></i></span>';
						echo 'Download<br /><small>Gimme it!</small>';
				echo '</a>';
			}

            if(isset($infos['as3gg_buy']) && $infos['as3gg_buy'] != '') {
				echo '<a href="'.$infos['as3gg_buy'].'" target="_blank" class="large yellow awesome" style="margin-bottom: 10px;">';
						echo '<span><i class="fa fa-camera-retro fa-2x"></i></span>';
						echo 'Buy item <small>from author</small>';
				echo '</a>';
			}

            if(isset($infos['as3gg_twitter']) && $infos['as3gg_twitter'] != '') {
				echo '<img src="http://avatars.io/twitter/'. $raw_infos['as3gg_twitter'][0].'" width="36" height="36" style="margin: 0 8px 0 0;" />';
				echo '<p><strong>'.$infos['as3gg_twitter'].'</strong><br />Author</p>';				
			}
			
			if(isset($infos['as3gg_hide_license']) && $infos['as3gg_hide_license'] == false) {
				echo '<span><i class="fa fa-book fa-3x"></i></span>';
				echo '<p><strong>'.$infos['as3gg_license'].'</strong><br />License</p>';
			}
			
			if(isset($infos['as3gg_site']) && $infos['as3gg_site'] != '') {
				echo '<span><i class="fa fa-link fa-3x"></i></span>';
				echo '<p><strong>'.$infos['as3gg_site'].'</strong><br />Website</p>';
			}
			
			if(isset($infos['as3gg_repo']) && $infos['as3gg_repo'] != '') {
                $icon = isset($infos['as3gg_repo_info']) ? $infos['as3gg_repo_info']['icon'] : 'code';
				echo '<span><i class="fa fa-'.$icon.' fa-3x"></i></span>';
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