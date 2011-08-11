<?php
/*
Plugin Name: As3GameGears Sideinfo
Plugin URI: http://as3gamegears.com/sideinfo
Description: Displays stats about the project being visualized on As3GameGears.
Version: 1.0
Author: Fernando Bevilacqua
Author URI: http://as3gamegears.com
Author Email: dovyski@gmail.com
License:

	Copyright (C) 2011 by Fernando Bevilacqua
	
	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:
	
	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/

class As3ggSideinfo extends WP_Widget {

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	
	/**
	 * The widget constructor. Specifies the classname and description, instantiates
	 * the widget, loads localization files, and includes necessary scripts and
	 * styles.
	 */
	function As3ggSideinfo() {
		// Define constnats used throughout the plugin
	    $this->init_plugin_constants();
	  
		$widget_opts = array (
			'classname' 	=> PLUGIN_NAME, 
			'description' 	=> __('Displays information about the project the user is currently viewing.', PLUGIN_LOCALE),
		);	
			
		$this->WP_Widget(PLUGIN_SLUG, __(PLUGIN_NAME, PLUGIN_LOCALE), $widget_opts);
		load_plugin_textdomain(PLUGIN_LOCALE, false, dirname(plugin_basename( __FILE__ ) ) . '/lang/' );
			
	    // Load JavaScript and stylesheets
	    //$this->register_scripts_and_styles();
	}

	/*--------------------------------------------------*/
	/* API Functions
	/*--------------------------------------------------*/
	
	/**
	 * Outputs the content of the widget.
	 *
	 * @args			The array of form elements
	 * @instance
	 */
	function widget($args, $instance) {
		if(!is_single()) {
			return;
		}
	
    	$raw_infos 					= get_post_meta(get_the_ID(), '', false);
    	$infos['as3gg_license']		= $this->make_pretty_license_link();
    	$infos['as3gg_site']		= $this->make_pretty_website_link($raw_infos['as3gg_site'][0]);  
    	$infos['as3gg_twitter']		= $this->make_pretty_twitter_link($raw_infos['as3gg_twitter'][0]);    	
    	$infos['as3gg_repo']		= $this->make_pretty_repo_link($raw_infos['as3gg_repo'][0]);
		$infos['as3gg_stats']		= $this->make_pretty_stats_link($raw_infos['as3gg_stats'][0]);
    	
		// Display the widget
		include(WP_PLUGIN_DIR . '/' . PLUGIN_SLUG . '/views/widget.php');
	}
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @new_instance	The previous instance of values before the update.
	 * @old_instance	The new instance of values to be generated via the update.
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// TODO Update the widget with the new values
		return $instance;
	}
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @instance	The array of keys and values for the widget.
	 */
	function form($instance) {
		// TODO define default values for your variables
		$instance = wp_parse_args(
			(array)$instance,
			array(
				'' => ''
			)
		);
	
		// TODO store the values of widget in a variable
		
		// Display the admin form
		include(WP_PLUGIN_DIR . '/' . PLUGIN_SLUG . '/views/admin.php');
	}
	
	/*--------------------------------------------------*/
	/* Private Functions
	/*--------------------------------------------------*/
	
	/**
	 * Initializes constants used for convenience throughout 
	 * the plugin.
	 */
	private function init_plugin_constants() {
		if(!defined('PLUGIN_LOCALE')) {
			define('PLUGIN_LOCALE', 'as3gg-sideinfo-locale');
	    }
	    
	    if(!defined('PLUGIN_NAME')) {
			define('PLUGIN_NAME', 'As3gg Sideinfo');
	    }
	    
		if(!defined('PLUGIN_SLUG')) {
			define('PLUGIN_SLUG', 'as3gg-sideinfo');
	    }
	}
  
	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {
		if(is_admin()) {
      		$this->load_file(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/js/admin.js', true);
			$this->load_file(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/css/admin.css');
		} else { 
      		$this->load_file(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/js/admin.css', true);
			$this->load_file(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/css/widget.css');
		}
	}

	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name	The 	ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file($name, $file_path, $is_script = false) {
    	$url 	= WP_PLUGIN_URL . $file_path;
		$file 	= WP_PLUGIN_DIR . $file_path;
    
		if(file_exists($file)) {
			if($is_script) {
				wp_register_script($name, $url);
				wp_enqueue_script($name);
			} else {
				wp_register_style($name, $url);
				wp_enqueue_style($name);
			}
		}
	}
	
	private function make_pretty_license_link() {
		$tags_list 	= get_the_tag_list('', ', ');
		return $tags_list ? $tags_list : 'Unknown';
	}	
	
	private function make_pretty_website_link($url) {
		$return 	= '';
		$url_limit 	= 18; 
		
		if($url != '') {
			$parts = explode('.', $url);
			
			if(preg_match('$https?://www?$i', $parts[0])) {
				unset($parts[0]);
			} else if(preg_match('$https?://$i', $parts[0])) {
				$parts[0] = substr($parts[0], strpos($parts[0], ':') + 3, 999);
			}
			
			$text	= implode('.', $parts);
			$text 	= strlen($text) > $url_limit ? substr($text, 0, $url_limit) . '...' : $text;
			$return = '<a href="'.$url.'" target="_blank">'.$text.'</a>';
		}
		
		return $return;
	}

	private function make_pretty_twitter_link($twitter_account) {
		return $twitter_account != '' ? '<a href="http://twitter.com/'.$twitter_account.'" target="_blank">@'.$twitter_account.'</a>' : $twitter_account;
	}

	private function make_pretty_repo_link($repo_url) {
		$ret = '';
		
		if($repo_url != '') {
			if(strpos($repo_url, 'github.com') !== false) {
				$ret = '<a href="'.$repo_url.'" target="_blank">GitHub</a>';
				
			} else if(strpos($repo_url, 'googlecode.com') !== false) {
				$ret = '<a href="'.$repo_url.'" target="_blank">Google Code</a>';				
			}
		}
		
		return $ret;
	} 		
	
	private function make_pretty_stats_link($project_id) {
		return $project_id;
	} 		
}

add_action('widgets_init', create_function('', 'register_widget("As3ggSideinfo");'));
?>