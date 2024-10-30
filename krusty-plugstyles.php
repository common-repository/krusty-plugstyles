<?php
/*
Plugin Name: Krusty PlugStyles
Plugin URI: http://www.rustykruffle.com/wordpress-plugins/krusty-plugstyles
Description: Load a custom css files from a themes directory to easily override styles for plugins and theme tweaks.
Version: 1.1.0
Author: Krusty Ruffle
Author URI: http://www.rustykruffle.com
*/
/*
	Copyright 2008  Krusty Ruffle  (email : krustyruffle@rustykruffle.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/**
 * Include a link to the current templates tweaks.css if it exists
 *
 * @package Krusty PlugStyles
 * @since 0.1
 * @uses STYLESHEETPATH Defines directory path to current stylesheet
 * @uses wp_register_style() Registers a stylesheet with WordPress
 * @uses wp_enqueue_style() Queues a stylesheet for inclusion when style are printed by WordPress
 * @uses add_action() Calls 'wp_head' action with 'wp_print_styles' value
 */
function krusty_plugstyles(){
	if(file_exists(STYLESHEETPATH . '/tweaks.css')){
		// register and enqueue our css for later addition into the head of the page
		wp_register_style('krusted-plugstyles', get_stylesheet_directory_uri() . '/tweaks.css', array(), '', 'screen');
		wp_enqueue_style('krusted-plugstyles');

		// since wp_print_styles() doesn't seem to run by default
		// we add a call to it with the wp_head action hook
		// set the timing to 9 to match the timing WP 2.7 will have when it comes out
		add_action('wp_head', 'wp_print_styles', '9');
	}
}

/**
 * Copy out the tweaks.css file so it is not wiped out when wordpress updates a theme.
 *
 * @package Krusty Plugstyles
 * @since 1.1.0
 * @param string update_feedback
 * @uses $wp_filesystem
 * @uses get_themes()
 * @return update_feedback Possibly modified.
 */
function krusty_update_dodger($update_feedback){
	if (__('Removing the old version of the theme') === $update_feedback){
		global $wp_filesystem;

		//Get the base theme folder
		$themes_dir = $wp_filesystem->wp_themes_dir();
		//And the same for the Content directory.
		$content_dir = $wp_filesystem->wp_content_dir();

		$themes_dir = trailingslashit( $themes_dir );
		$content_dir = trailingslashit( $content_dir );

		$themes = get_themes();
		foreach ( (array) $themes as $this_theme ) {
			if ( $this_theme['Stylesheet'] == $_GET['theme'] ) {
				$theme_directory = preg_replace('!^/themes/!i', '', $this_theme['Stylesheet Dir']);
				break;
			}
		}
		unset($themes);

		$working_dir = $content_dir . 'upgrade/' . basename($theme_directory);

		if (is_dir($themes_dir . $theme_directory) && file_exists($themes_dir . $theme_directory . '/tweaks.css')){
			if(!copy($themes_dir . $theme_directory . '/tweaks.css', $working_dir . '/' . $theme_directory . '/tweaks.css'))
				$update_feedback .= "\n" . 'Failed to copy tweaks.css!' . "\n";
		}else{
			$update_feedback .= "\n" . 'tweaks.css file not found for this theme!' . "\n";
		}
	}
	return $update_feedback;
}

// add a filter to dodge the upgrade delation...
add_filter('update_feedback', 'krusty_update_dodger', '1');
// add an action to call our function when wordpress starts loading a page
add_action('init', 'krusty_plugstyles');
?>