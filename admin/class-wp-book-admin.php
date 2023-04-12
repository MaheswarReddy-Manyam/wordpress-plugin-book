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
        'publicly_querable' => true,
        'show_ui'           => true,
        'public'            => true,
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

    // create custom hierarchical category book
    public function custom_category_book()
    {

        $labels = array(
        'name'                       => _x('Book Categories', 'taxonomy general name', 'wp-book'), //phpcs:ignore
        'singular_name'              => _x('Book Category', 'taxonomy singular name', 'wp-book'), //phpcs:ignore
        'menu_name'                  => __('Book Category', 'wp-book'),
        'all_items'                  => __('All Items', 'wp-book'),
        'parent_item'                => __('Parent Item', 'wp-book'),
        'parent_item_colon'          => __('Parent Item:', 'wp-book'),
        'new_item_name'              => __('Add Book Category', 'wp-book'),
        'add_new_item'               => __('Add New Book Category', 'wp-book'),
        'edit_item'                  => __('Edit Book Category', 'wp-book'),
        'update_item'                => __('Update Book Category', 'wp-book'),
        'view_item'                  => __('View Book Category', 'wp-book'),
        'search_items'               => __('Search Items', 'wp-book'),
        'not_found'                  => __('Not Found', 'wp-book'),
        'no_terms'                   => __('No items', 'wp-book'),
        'items_list'                 => __('Items list', 'wp-book'),
        'items_list_navigation'      => __('Items list navigation', 'wp-book'),
        );

        $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true,
        );

        register_taxonomy('Book Category', array('book'), $args);
    }

    public function custom_book_tag() 
    {

        $labels = array(
        'name'                       => _x('Book Tags', 'taxonomy general name', 'wp-book'),
        'singular_name'              => _x('Book Tag', 'taxonomy singular name', 'wp-book'),
        'menu_name'                  => __('Book Tag', 'wp-book'),
        'all_items'                  => __('All Book Tags', 'wp-book'),
        'new_item_name'              => __('Add Book Tag', 'wp-book'),
        'add_new_item'               => __('Add New Book Tag', 'wp-book'),
        'edit_item'                  => __('Edit Book Tag', 'wp-book'),
        'update_item'                => __('Update Book Tag', 'wp-book'),
        'view_item'                  => __('View Book Tag', 'wp-book'),
        'separate_items_with_commas' => __('Separate items with commas', 'wp-book'),
        'add_or_remove_items'        => __('Add or remove items', 'wp-book'),
        'choose_from_most_used'      => __('Choose from the most used tags', 'wp-book'),
        'popular_items'              => __('Popular Items', 'wp-book'),
        'search_items'               => __('Search Book Tag', 'wp-book'),
        'not_found'                  => __('Not Book Tag Found', 'wp-book'),
        'no_terms'                   => __('No items', 'wp-book'),
        'items_list'                 => __('Items list', 'wp-book'),
        'items_list_navigation'      => __('Items list navigation', 'wp-book'),
        );

        $args = array(
        'labels'            => $labels,
        'hierarchical'      => false,
        'public'            => true,
        'show_admin_column' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true,
        );

        register_taxonomy('Book Tag', array("book"), $args);
    }

    // Creates custom meta box
    public function custom_metabox_books()
    {
        add_meta_box('custom-books-info', __('Book Information', 'wp-book'), array( $this, 'custom_books_info_function' ), array( 'book' ), 'normal', 'default'); 
    }

     // creates custom meta table
    public function wpb_register_book_metatable() 
    {
        global $wpdb;
 
        // Registering the meta table
        $wpdb->bookmeta = $wpdb->prefix . 'bookmeta';
    }
    /**
     * Shows custom metabox books and get values for wp_bookmeta (if any).
     *
     * @since 1.0.0
     * @param object $post Contains all information about post
     */
    public function custom_books_info_function( $post )
    {

        // Use get_metadata to retrieve existing data from the database.
        $get_book_metadata = get_metadata('book', $post->ID);
        if (count($get_book_metadata) > 0 ) {
            $author    = $get_book_metadata['author_name'][0];
            $price     = $get_book_metadata['price'][0];
            $publisher = $get_book_metadata['publisher'][0];
            $year      = $get_book_metadata['year'][0];
            $edition   = $get_book_metadata['edition'][0];
            $url       = $get_book_metadata['url'][0];
        } else {
            $author    = '';
            $price     = '';
            $publisher = '';
            $year      = '';
            $edition   = '';
            $url       = '';
        }

        // Add an nonce field so we can check for it later.
        wp_nonce_field(basename(__FILE__), 'custom_books_info_nonce');
        ?>

        <!-- Display the meta box, using the current value. -->
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="wpb-custom-author-name"><?php _e('Author Name', 'wp-book')?></label></th>
                    <td><input name="wpb-custom-author-name" type="text" id="wpb-custom-author-name" value="<?php esc_attr_e($author, 'wp-book'); ?>" placeholder="<?php _e('Author Name', 'wp-book') ?>" class="regular-text" autocomplete="off"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="wpb-custom-price"><?php _e('Book Price', 'wp-book')?></label></th>
                    <td><input name="wpb-custom-price" type="text" id="wpb-custom-price" value="<?php esc_attr_e($price, 'wp-book'); ?>" placeholder="<?php _e('Book Price', 'wp-book') ?>" class="regular-text" autocomplete="off"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="wpb-custom-publisher"><?php _e('Publisher', 'wp-book')?></label></th>
                    <td><input name="wpb-custom-publisher" type="text" id="wpb-custom-publisher" value="<?php esc_attr_e($publisher, 'wp-book'); ?>" placeholder="<?php _e('Publisher', 'wp-book') ?>" class="regular-text" autocomplete="off"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="wpb-custom-year"><?php _e('Year', 'wp-book')?></label></th>
                    <td><input name="wpb-custom-year" type="number" id="wpb-custom-year" value="<?php esc_attr_e($year, 'wp-book'); ?>" placeholder="<?php _e('Year', 'wp-book') ?>" class="regular-text" autocomplete="off"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="wpb-custom-edition"><?php _e('Edition', 'wp-book')?></label></th>
                    <td><input name="wpb-custom-edition" type="text" id="wpb-custom-edition" value="<?php esc_attr_e($edition, 'wp-book'); ?>" placeholder="<?php _e('Edition', 'wp-book') ?>" class="regular-text" autocomplete="off"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="wpb-custom-url"><?php _e('URL', 'wp-book')?></label></th>
                    <td><input name="wpb-custom-url" type="url" id="wpb-custom-url" value="<?php echo esc_url($url, 'wp-book'); ?>" placeholder="<?php _e('URL eg. https://example.com', 'wp-book')?>" class="regular-text" autocomplete="off"></td>
                </tr>
            </tbody>
        </table>
        <?php
    }

    /**
     * Stores all metadata of custom post type to custom table called wp_bookmeta
     *
     * @since 1.0.0
     * @param integer $post_id Contains Post ID
     * @param object  $post    Contains all information about post
     */
    public function save_custom_metabox_data( $post_id, $post )
    {
        /*
        * We need to verify this came from the our screen and with proper authorization,
        * because save_post can be triggered at other times.
        */

        // Check if our nonce is set or Verify that the nonce is valid.
        if (! isset($_POST['custom_books_info_nonce']) || ! wp_verify_nonce($_POST['custom_books_info_nonce'], basename(__FILE__)) ) {
            return $post_id;
        }

        $post_slug = 'book';

        if ($post_slug != $post->post_type ) {
            return;
        }

        $author = '';
        if (isset($_POST['wpb-custom-author-name']) ) {
            $author = sanitize_text_field($_POST['wpb-custom-author-name']);
        } else {
            $author = '';
        }

        $price = '';
        if (isset($_POST['wpb-custom-price']) ) {
            $price = sanitize_text_field($_POST['wpb-custom-price']);
        } else {
            $price = '';
        }

        $publisher = '';
        if (isset($_POST['wpb-custom-publisher']) ) {
            $publisher = sanitize_text_field($_POST['wpb-custom-publisher']);
        } else {
            $publisher = '';
        }

        $year = '';
        if (isset($_POST['wpb-custom-year']) ) {
            $year = sanitize_text_field($_POST['wpb-custom-year']);
        } else {
            $year = '';
        }

        $edition = '';
        if (isset($_POST['wpb-custom-edition']) ) {
            $edition = sanitize_text_field($_POST['wpb-custom-edition']);
        } else {
            $edition = '';
        }

        $url = '';
        if (isset($_POST['wpb-custom-url']) ) {
            $url = sanitize_text_field($_POST['wpb-custom-url']);
        } else {
            $url = '';
        }
       
        update_metadata('book', $post_id, 'author_name', $author);
        update_metadata('book', $post_id, 'price', $price);
        update_metadata('book', $post_id, 'publisher', $publisher);
        update_metadata('book', $post_id, 'year', $year);
        update_metadata('book', $post_id, 'edition', $edition);
        update_metadata('book', $post_id, 'url', $url);
    }
}
