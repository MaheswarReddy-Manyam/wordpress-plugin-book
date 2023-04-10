<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @package Wp_Book
 * @link    https://https://github.com/MaheswarReddy-Manyam
 * @since   1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       WP-Book
 * Plugin URI:        https://github.com/MaheswarReddy-Manyam/wordpress-plugin-book
 * Description:       This Plugin creates a custom post type Book with Book Category and Book Tag as hierarchical and non-hierarchical taxonomies respectively. Creates a Meta box to save book meta information like Author Name, Price, etc. and a custom meta table to save all book meta info. Also creates a custom settings page, a [book] shortcode, a gutenberg block widget and a custom dashboard widget which shows the top 5 book categories.
 * Version:           1.0.0
 * Author:            Maheswar Manyam
 * Author URI:        https://https://github.com/MaheswarReddy-Manyam
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-book
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC') ) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('WP_BOOK_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-book-activator.php
 */
function activate_wp_book()
{
    include_once plugin_dir_path(__FILE__) . 'includes/class-wp-book-activator.php';
    Wp_Book_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-book-deactivator.php
 */
function deactivate_wp_book()
{
    include_once plugin_dir_path(__FILE__) . 'includes/class-wp-book-deactivator.php';
    Wp_Book_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_wp_book');
register_deactivation_hook(__FILE__, 'deactivate_wp_book');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-wp-book.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_wp_book()
{

    $plugin = new Wp_Book();
    $plugin->run();

}
run_wp_book();
