=== Krusty Plugstyles ===
Tags: css, style, theme, wpmu
Requires at least: 2.6
Tested up to: 2.7
Stable tag: trunk

Allows a user to modify front-end, (public) styles without modifying theme/plugin/core files.

== Description ==

This plugin will check for the existance of a file named 'tweaks.css' in the current theme directory. If the file exists it will load it into the head section of pages on the WordPress frontend. Custom css rules in the file an be used to tweak the appearance of your WordPress site. This is a simple solution for plugins that don't quite match your theme, or little things that you feel need some adjustment in your sites theme. It is especially useful when used with a themes that is rich with class tags like, for exapmple [The Sandbox](http://www.plaintxt.org/themes/sandbox/ "The Sandbox theme for WordPress").
If you have any questions, suggestions, or comments feel free to drop by [the Krusty Plugstyles page](http://rustykruffle.com/wordpress-plugins/krusty-plugstyles "home page for Krusty Plugstyles") at [rustykruffle.com](http://rustykruffle.com "my website").


== Installation ==
WordPress Users:

1. Unzip the `krusty-plugstyles.zip` file
1. Upload the `krusty-plugstyles` directory to the `/wp-content/plugins/` directory on your server
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place a file called `tweaks.css` into your themes directory. This file can be edited before uploading, or it can be edited by selecting `tweaks.css` on the `Edit Themes` page in WordPress.

WordPress MU Users:

1. Unzip the `krusty-plugstyles.zip` file
1. Upload the `krusty-plugstyles` directory to the `/wp-content/plugins/` directory on your server, (requires activation on each blog), or copy the `krusty-plugstyles.php` file from the `krusty-plugstyles` directory to `wp-content/mu-plugins` for automatic use on all blogs.
1. Activate the plugin through the 'Plugins' menu in WordPress, (not needed if uploaded to the `wp-content/mu-plugins` directory)
1. Place a file called `tweaks.css` into your current themes root directory. This file can be edited before uploading, or it can be edited by selecting `tweaks.css` on the `Edit Themes` page in WordPress.

== Changelog ==

Version 1.00

* Initial release

Version 1.1.0

* Added function to get around tweaks.css being deleted when a theme is updated with the automatic update features of WordPress 2.7
* Added changelog to readme.txt file.
* Added 'wpmu' to the tags list.
* Several minor fixes to the readme.txt file.

== Frequently Asked Questions ==

= Can this plugin be used on more than one theme at a time? =

Yes. You can put a different `tweaks.css` file in every themes root directory. Only the file that is in the directory of the current theme will be loaded.

= Will it work with plugins that allow users to select their themes? =

I have only tested it with [Theme Switcher Reloaded](http://wordpress.org/extend/plugins/theme-switcher-reloaded/ "A plugin that allows users to switch themes") but it works fine with it.
