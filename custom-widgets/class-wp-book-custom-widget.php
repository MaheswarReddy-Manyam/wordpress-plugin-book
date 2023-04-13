<?php 

/**
 * The custom widgets functionality of the plugin.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/custom-widgets
 * @author     Maheswar Manyam <maheswar.manyam@hbwsl.com>
 * @link       https://https://github.com/MaheswarReddy-Manyam
 * @since      1.0.0
 */

function wpb_book_widget_init()
{
    register_widget('WPB_Book_Widget');
}

class WPB_Book_Widget extends WP_Widget
{
    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname'                   => 'wpb_book_widget',
            'description'                 => __('Books of selected category', 'wp-book'),
            'customize_selective_refresh' => true, // when editing the widget so instead of refreshing the entire page only the widget is refreshed when making changes.
        );
        parent::__construct('wpb_book_widget', __('Book Widget', 'wp-book'), $widget_ops);
    }

    /**
     * Outputs the content/look of the widget
     *
     * @param array $args     The arguments parameter.
     * @param array $instance The instance parameter.
     */
    public function widget( $args, $instance )
    {
        // outputs the content of the widget
        echo $args["before_widget"];
        echo $args["before_title"];
        $cond = array(
        'post_type' => "book",
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'Book Category',
                'field'    => 'slug',
                'terms'    => $instance['selected-cat'],
            ),
        ),
        );
        $query = new WP_Query($cond);
        echo "<h3>"."Book list of Category : ".$instance["selected-cat"]."</h3>";
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                echo "<h5>".get_the_title()."</h5>";
            }
            wp_reset_postdata();
        } else {
            echo "No Book available of this category.";
        }
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance )
    {
        // Set widget defaults.
        $defaults = array(
        'selected-cat' => '',
        );
        $fields = get_terms(array("taxonomy"=>"Book Category",'hide_empty' => false));
        extract(wp_parse_args((array) $instance, $defaults)); 
        ?>
        <div>
            <label for=<?php echo $this->get_field_id("selected-cat")?>> <?php _e('Select a book category', 'wp-book') ?></label>
            <select  name=<?php echo $this->get_field_name("selected-cat")?> id=<?php echo $this->get_field_id("selected-cat")?>>
        <?php
        for ($i=0;$i<count($fields);$i++) {
            ?>
            <option value=<?php echo $fields[$i]->name?> >
            <?php echo $fields[$i]->name ?>
            </option>
            <?php
        }
        ?>
        </select>
        </div>
        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update( $new_instance, $old_instance )
    {
        // processes widget options to be saved
        $instance = array();
        $instance["selected-cat"] = !empty($new_instance["selected-cat"])? strip_tags($new_instance['selected-cat']) : "" ;
        return $instance;
    }
}
