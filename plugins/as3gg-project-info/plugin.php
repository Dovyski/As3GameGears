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

class As3ggProjectInfo extends WP_Widget {

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	
	/**
	 * The widget constructor. Specifies the classname and description, instantiates
	 * the widget, loads localization files, and includes necessary scripts and
	 * styles.
	 */
	function As3ggProjectInfo() {
		// Define constnats used throughout the plugin
	    $this->init_plugin_constants();
	  
	    // TODO: update classname and description
		$widget_opts = array (
			'classname' => PLUGIN_NAME, 
			'description' => __('Short description of the plugin goes here.', PLUGIN_LOCALE)
		);	
			
		$this->WP_Widget(PLUGIN_SLUG, __(PLUGIN_NAME, PLUGIN_LOCALE), $widget_opts);
		load_plugin_textdomain(PLUGIN_LOCALE, false, dirname(plugin_basename( __FILE__ ) ) . '/lang/' );
			
	    // Load JavaScript and stylesheets
	    $this->register_scripts_and_styles();
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
		//extract($args, EXTR_SKIP);
		//echo $before_widget;
	
		// TODO: This is where you retrieve the widget values
    
		// Display the widget
		include(WP_PLUGIN_DIR . '/' . PLUGIN_SLUG . '/views/widget.php');
		
		//echo $after_widget;
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
			define('PLUGIN_LOCALE', 'plugin-name-locale');
	    }
	    
	    if(!defined('PLUGIN_NAME')) {
			define('PLUGIN_NAME', 'As3gg Project Info');
	    }
	    
		if(!defined('PLUGIN_SLUG')) {
			define('PLUGIN_SLUG', 'as3gg-project-info');
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
}

add_action('widgets_init', create_function('', 'register_widget("As3ggProjectInfo");'));
?>