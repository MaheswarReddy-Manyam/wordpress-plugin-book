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

    // Custom Admin Settings page for Book
    public function wpb_custom_book_admin_page()
    {
        add_menu_page('Booksmenu', __('Book Settings', 'wp-book'), 'manage_options', 'book-settings', array( $this, 'book_settings_page' ), 'dashicons-book-alt', 75);
    }

    // "Book Settings" menu callback function
    public function book_settings_page()
    {
        ob_start();
        ?>
        <div class="wrap">
        <?php
        // add error/update messages

        // check if the user have submitted the settings
        // WordPress will add the "settings-updated" $_GET parameter to the url
        if (isset($_GET['settings-updated']) ) {
            // add settings saved message with the class of "updated"
            add_settings_error('bookmenu_messages', 'bookmenu_message', __('Settings Saved', 'wp-book'), 'success');
        }
        // show error/update messages
        settings_errors('bookmenu_messages');
        
        ?>
            <h2><?php esc_html_e('Book Settings', 'wp-book'); ?></h2>
            <p><?php esc_html_e('Manages all the settings of book plugin', 'wp-book')?></p>

            <form method="post" action="options.php">
        <?php settings_fields('book_settings_group'); ?>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="book_currency"><?php esc_html_e('Currency', 'wp-book'); ?></label></th>
        <?php $currency_option = get_option('book_currency'); ?>
                            <td>
                                <select name="book_currency" id="book_currency" value="<?php echo get_option('book_currency'); ?>" class="regular-text">
                                    <option value="INR" <?php selected($currency_option, 'INR'); ?> ><?php esc_html_e('INR', 'wp-book');?></option>
                                    <option value="USD" <?php selected($currency_option, 'USD'); ?> ><?php esc_html_e('US Dollar', 'wp-book');?></option>
                                    <option value="GBP" <?php selected($currency_option, 'GBP'); ?> ><?php esc_html_e('Great Britain Pound', 'wp-book');?></option>
                                    <option value="AUD" <?php selected($currency_option, 'AUD'); ?> ><?php esc_html_e('Australia Dollar', 'wp-book');?></option>
                                    <option value="JPY" <?php selected($currency_option, 'JPY'); ?> ><?php esc_html_e('Japan Yen', 'wp-book');?></option>
                                    <option value="CNY" <?php selected($currency_option, 'CNY'); ?> ><?php esc_html_e('Chinese Yuan', 'wp-book');?></option>                                   
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="book_no_per_page"><?php esc_html_e('No. of Books(per page)', 'wp-book')?></label></th>
                            <td><input type="text" class="regular-text" name="book_no_per_page" id="book_no_per_page" placeholder="No. of Books" value="<?php echo get_option('book_no_per_page'); ?>"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Save Settings" class="button-primary"></td>
                        </tr>
                        <!-- <?php submit_button('Save Settings')?> -->
                    </tbody>
                </table>
            </form>
        </div>
        <?php
        echo ob_get_clean();
    }

    // Registers the settings group for each input field
    public function register_book_settings()
    {
        register_setting('book_settings_group', 'book_currency');
        register_setting('book_settings_group', 'book_no_per_page');
    }

    // Create a custom widget for dashboard
    public function custom_dashboard_widget()
    {
        wp_add_dashboard_widget('book_widget', __('Top 5 Book Categories', 'wp-book'), array( $this, 'custom_dashboard_helper' ), 'null', 'null', 'column3');
    }

    // Provides Top 5 categories of book post type based on their count
    function custom_dashboard_helper()
    {
        global $wpdb;
        $get_category_term_ids   = $wpdb->get_col("SELECT term_id FROM `wp_term_taxonomy` WHERE taxonomy = 'Book Category' ORDER BY count DESC LIMIT 5");
        $top_category_name = array();
        $top_category_slug = array();
        foreach ( $get_category_term_ids as $id ) {
            $get_term = $wpdb->get_row("SELECT name, slug FROM wp_terms WHERE term_id = $id", 'ARRAY_A');
            array_push($top_category_name, $get_term['name']);
            array_push($top_category_slug, $get_term['slug']);
        }
        ?>
        <ol>
        <?php
        for ( $i = 0; $i < count($top_category_name); $i++ ) {
            ?>
            <li style='font-size:15px;'> <a href=" <?php echo esc_url( get_site_url() ); ?>/wp-admin/edit.php?post_type=book&book-category=<?php echo esc_attr( $top_category_slug[ $i ] ); ?>" target='_blank'><?php esc_attr_e($top_category_name[ $i ], 'wp-book'); ?></li>
            <?php
        }
        ?>
        </ol>
        <?php
    }
}
