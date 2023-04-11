<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 * @link       https://https://github.com/MaheswarReddy-Manyam
 * @since      1.0.0
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 * 
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 * @author     Maheswar Manyam <maheswar.manyam@hbwsl.com>
 * @since      1.0.0
 */
class Wp_Book_i18n
{


    /**
     * Load the plugin text domain for translation.
     *
     * @since 1.0.0
     */
    public function load_plugin_textdomain()
    {

        load_plugin_textdomain(
            'wp-book',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );

    }



}
