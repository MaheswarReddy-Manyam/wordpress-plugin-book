<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 * @link       https://https://github.com/MaheswarReddy-Manyam
 * @since      1.0.0
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 * @author     Maheswar Manyam <maheswar.manyam@hbwsl.com>
 * @since      1.0.0
 */
class Wp_Book
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since  1.0.0
     * @access protected
     * @var    Wp_Book_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since  1.0.0
     * @access protected
     * @var    string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since  1.0.0
     * @access protected
     * @var    string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     * 
     * phpcs:disable
     * 
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * phpcs:enable
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        if (defined('WP_BOOK_VERSION') ) {
            $this->version = WP_BOOK_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'wp-book';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Wp_Book_Loader. Orchestrates the hooks of the plugin.
     * - Wp_Book_i18n. Defines internationalization functionality.
     * - Wp_Book_Admin. Defines all hooks for the admin area.
     * - Wp_Book_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since  1.0.0
     * @access private
     */
    private function load_dependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        include_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-wp-book-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        include_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-wp-book-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        include_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-wp-book-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        include_once plugin_dir_path(dirname(__FILE__)) . 'public/class-wp-book-public.php';

        include_once plugin_dir_path(dirname(__FILE__)) . 'custom-widgets/class-wp-book-custom-widget.php';

        $this->loader = new Wp_Book_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Wp_Book_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since  1.0.0
     * @access private
     */
    private function set_locale()
    {

        $plugin_i18n = new Wp_Book_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since  1.0.0
     * @access private
     */
    private function define_admin_hooks()
    {

        $plugin_admin = new Wp_Book_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

        // action hook for custom post type book
        $this->loader->add_action('init', $plugin_admin, 'custom_post_type_book');

        // action hook for custom hierarchical taxonomy Book Category
        $this->loader->add_action('init', $plugin_admin, 'custom_category_book');

        // action hook for custom non-hierarchical taxonomy Book Tag
        $this->loader->add_action('init', $plugin_admin, 'custom_book_tag');
        
        // action hook for custom metabox
        $this->loader->add_action('add_meta_boxes', $plugin_admin, 'custom_metabox_books');
        
        // action hook to store metadata of custom metabox book
        $this->loader->add_action('save_post', $plugin_admin, 'save_custom_metabox_data', 10, 2);
        
        // action hook for registering the custom table named bookmeta
        $this->loader->add_action('plugins_loaded', $plugin_admin, 'wpb_register_book_metatable'); //phpcs:disable

        // action hook to add book admin page to admin menu
        $this->loader->add_action('admin_menu',$plugin_admin, 'wpb_custom_book_admin_page');

        // action hook for registering settings of book
        $this->loader->add_action('admin_init',$plugin_admin, 'register_book_settings');

        // action hook to display widget on dashboard of top 5 categories of book post type based on their count
		$this->loader->add_action( 'wp_dashboard_setup', $plugin_admin, 'custom_dashboard_widget' );
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since  1.0.0
     * @access private
     */
    private function define_public_hooks()
    {

        $plugin_public = new Wp_Book_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

        // Add shortcode named book to display book information
        add_shortcode('book', array($plugin_public, 'wpb_custom_shortcode'));

        // action hook to display custom widget which shows books of selected category.
		add_action( 'widgets_init', 'wpb_book_widget_init' );
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since 1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since  1.0.0
     * @return string    The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since  1.0.0
     * @return Wp_Book_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since  1.0.0
     * @return string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }

}
