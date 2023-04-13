<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/public
 * @link       https://https://github.com/MaheswarReddy-Manyam
 * @since      1.0.0
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/public
 * @author     Maheswar Manyam <maheswar.manyam@hbwsl.com>
 */
class Wp_Book_Public
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
     * @param string $plugin_name The name of the plugin.
     * @param string $version     The version of this plugin.
     * 
     * @since 1.0.0
     */
    public function __construct( $plugin_name, $version )
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wp-book-public.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wp-book-public.js', array( 'jquery' ), $this->version, false);

    }
    /**
     * Returns the information of book to shortcode named [book].
     *
     * @since 1.0.0
     * @param array $atts Contains the attributes passed in shortcode.
     */
    public function wpb_custom_shortcode( $atts )
    {
        // Default attributes
        $default=array(
            'id' => '0',
            'author_name' => '',
            'year' => '',
            'publisher'=> '',
            'price' => '',
            'url' => '',
            'category' => '',
            'tag' => '',
        );
        // Attributes
        $attributes = shortcode_atts($default, $atts);
        if ($attributes['category'] != "" || $attributes["tag"] != "") {

            // populating $args of WP_Query 
            $args = array(
            'p'              => $attributes['id'],
            'post_type'      => 'book',
            'post_status'    => 'publish',
            'posts_per_page' => get_option('book_no_per_page'),
            'tax_query'      => array(
            'relation' => 'OR',
            array(
            'taxonomy'         => 'Book Category',
            'field'            => 'slug',
            'terms'            => explode(',', $attributes['category']),
            'include_children' => true,
            'operator'         => 'IN',
            ),
            array(
            'taxonomy'         => 'Book Tag',
            'field'            => 'slug',
            'terms'            => explode(',', $attributes['tag']),
            'include_children' => false,
            'operator'         => 'IN',
            ),
            ),
            );
        } else if ($attributes['author_name'] != "" || $attributes["year"] != "" || $attributes["publisher"] != "" || $attributes["price"] != "" || $attributes["url"] != "") {
            
            // populating $args of WP_Query
            $args = array(
            'p'              => $attributes['id'],
            'post_type'      => 'book',
            'post_status'    => 'publish',
            'posts_per_page' => get_option('book_no_per_page'),
            'meta_query'     => array(
            'relation' => 'OR',
            array(
            'key'     => 'author_name',
            'value'   => explode(',', $attributes['author_name']),
            'compare' => 'IN',
            ),
            array(
            'key'     => 'year',
            'value'   => explode(',', $attributes['year']),
            'compare' => 'IN',
            ),
            array(
            'key'     => 'publisher',
            'value'   => explode(',', $attributes['publisher']),
            'compare' => 'IN',
            ),
            array(
            'key'     => 'price',
            'value'   => explode(',', $attributes['price']),
            'compare' => 'IN',
            ),
            array(
            'key'     => 'url',
            'value'   => explode(',', $attributes['url']),
            'compare' => 'IN',
            ),
            ),
            );
        } else {
            $args = array(
            'p'              => $attributes['id'],
            'post_type'      => 'book',
            'post_status'    => 'publish',
            'posts_per_page' => get_option('book_no_per_page'),
            );
        }

        $content = '';
        
        $query = new WP_Query($args);
        if ($query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $currency = get_option('book_currency');

                $book_metadata = get_metadata('book', get_the_ID());
                $currency_value = get_metadata('book', get_the_ID(), 'price', true);

                $book_metadata['author_name'][0]  = $book_metadata['author_name'][0] ? $book_metadata['author_name'][0] : 'N.A';
                $book_metadata['publisher'][0] = $book_metadata['publisher'][0] ? $book_metadata['publisher'][0] : 'N.A';
                $book_metadata['year'][0]      = $book_metadata['year'][0] ? $book_metadata['year'][0] : 'N.A';
                $book_metadata['edition'][0]   = $book_metadata['edition'][0] ? $book_metadata['edition'][0] : 'N.A';
                $book_metadata['url'][0]       = $book_metadata['url'][0] ? $book_metadata['url'][0] : 'N.A';

                // Currency conversion based on user settings
                if ('USD' === $currency ) {
                    $price = '&#36;' . (int) $currency_value * 0.012;
                } elseif ('INR' === $currency ) {
                    $price = '&#8377;' . (int) $currency_value;
                } elseif ('GBP' === $currency ) {
                    $price = '&#163;' . (int) $currency_value * 0.010;
                } elseif ('AUD' === $currency ) {
                    $price = 'A'.'&#36;' . (int) $currency_value * 0.018;
                } elseif ('JPY' === $currency ) {
                    $price = '&#165;' . (int) $currency_value * 1.62;
                } elseif ('CNY' === $currency ) {
                    $price = '&#20803;' . (int) $currency_value * 0.084;
                }
                
                // [book] shortcode view in front end
                ob_start();
                ?>
                <div class='wrap'>
                    <h4 style="text-decoration:underline;"><?php esc_html_e(get_the_title(), 'wp-book') ?></h4>
                    <table>
                        <tbody>
                            <tr>
                                <td ><?php esc_html_e('Author: ', 'wp-book') ?></td>
                                <td ><?php esc_html_e($book_metadata['author_name'][0], 'wp-book') ?></td>
                            </tr>
                            <tr>
                                <td ><?php esc_html_e('Price: ', 'wp-book') ?></td>
                                <td ><?php esc_html_e($price, 'wp-book') ?></td>
                            </tr>
                            <tr>
                                <td ><?php esc_html_e('Publisher: ', 'wp-book') ?></td>
                                <td ><?php esc_html_e($book_metadata['publisher'][0], 'wp-book') ?></td>
                            </tr>
                            <tr>
                                <td ><?php esc_html_e('Year: ', 'wp-book') ?></td>
                                <td ><?php esc_html_e($book_metadata['year'][0], 'wp-book') ?></td>
                            </tr>
                            <tr>
                                <td ><?php esc_html_e('Edition: ', 'wp-book') ?></td>
                                <td ><?php esc_html_e($book_metadata['edition'][0], 'wp-book') ?></td>
                            </tr>
                            <tr>
                                <td NOWRAP><?php esc_html_e('For more information: ', 'wp-book') ?></td>
                                <td ><a href="'.$book_metadata['url'][0].'" target="_blank"><?php echo esc_url($book_metadata['url'][0], 'wp-book') ?></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php
                
                $content .= ob_get_clean();
            }
        } else {
            $content .= '<h4 style="color:red; text-align:center">Book not found!!!</h4>';
        }

        return $content;
    }
}
