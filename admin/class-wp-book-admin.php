<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 * @link       https://https://github.com/MaheswarReddy-Manyam
 * @since      1.0.0
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 * @author     Maheswar Manyam <maheswar.manyam@hbwsl.com>
 */
class Wp_Book_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since 1.0.0
     * @param string $plugin_name The name of this plugin.
     * @param string $version     The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wp_Book_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wp_Book_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wp-book-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wp_Book_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wp_Book_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wp-book-admin.js', array( 'jquery' ), $this->version, false);

    }
    //Register custom post type "book"
    public function custom_post_type_book()
    {

        $labels = array(
        'name'               => _x('Book', 'Post Type General Name', 'wp-book'),
        'singular_name'      => _x('Book', 'Post Type Singular Name', 'wp-book'),
        'add_new'            => __('Add New', 'wp-book'),
        'add_new_item'       => __('Add New Book', 'wp-book'),
        'edit_item'          => __('Edit Book', 'wp-book'),
        'new_item'           => __('New Book', 'wp-book'),
        'all_items'          => __('All Books', 'wp-book'),
        'view_item'          => __('View Book', 'wp-book'),
        'search_items'       => __('Search Books', 'wp-book'),
        'not_found'          => __('No Books Found', 'wp-book'),
        'not_found_in_trash' => __('No Books Found in Trash', 'wp-book'),
        'menu_name'          => __('Book', 'wp-book'),
        );

        $args = array(
        'labels'            => $labels,
        'public'            => true,
        'publicly_querable' => true,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'book' ),
        'capability_type'   => 'post',
        'has_archive'       => true,
        'hieracrchical'     => false,
        'menu_icon'         => 'dashicons-book',
        'menu_position'     => 20,
        'supports'          => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
        );

        register_post_type('Book', $args);
    }
}
