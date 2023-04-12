<?php

/**
 * Fired during plugin activation
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 * @link       https://https://github.com/MaheswarReddy-Manyam
 * @since      1.0.0
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 * @author     Maheswar Manyam <maheswar.manyam@hbwsl.com>
 * @since      1.0.0
 */
class Wp_Book_Activator
{
    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since 1.0.0
     */
    public static function activate()
    {
        // Create a table bookmeta on activation onlf if it doesn't exist
        global $wpdb;
        if ($wpdb->get_var("SHOW TABLES LIKE '". Wp_Book_Activator::wpb_bookmeta(). "'") !=Wp_Book_Activator::wpb_bookmeta()) {

            // dynamic generate table
            $table_query = "CREATE TABLE '". Wp_Book_Activator::wpb_bookmeta() ."' (  
                meta_id bigint(20) NOT NULL AUTO_INCREMENT,  
                book_id bigint(20) NOT NULL DEFAULT '0',  
                meta_key varchar(255) DEFAULT NULL,  
                meta_value longtext,  
                PRIMARY KEY (meta_id),  
                KEY book_id (book_id),  
                KEY meta_key (meta_key))
                ENGINE=InnoDB DEFAULT CHARSET=utf8";

            include_once ABSPATH.'wp-admin/includes/upgrade.php';
            dbDelta($table_query);
        }
    }

    public static function wpb_bookmeta()
    {
        global $wpdb;
        return $wpdb->prefix . "bookmeta";
    }
}
