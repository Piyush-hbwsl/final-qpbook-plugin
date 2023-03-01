<?php

function book_widget_init()
{
    register_widget('book_Widget');
}

class book_Widget extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
        'classname'   => 'new_widget',
        'description' => 'New Widget is awesome',
        );
        parent::__construct('new_widget', 'new Widget', $widget_ops);
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance )
    {
        // outputs the content of the widgetc
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
        // print_r($query);
        if($query->have_posts()) {
            while($query->have_posts()){
                $query->the_post();
                echo "<h5>".get_the_title()."</h5>";
            }
            wp_reset_postdata();
        }
        else{
            echo "no post avialable of this category.";
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
        // Parse current settings with defaults.
        extract(wp_parse_args((array) $instance, $defaults)); 

        $title = !empty($instance["selected-cat"])?$instance["selected-cat"]:"";
        ?>
        <div>
            <label for="mybook">Select a book category</label>
            <select id="mybook" name=<?php echo $this->get_field_name("selected-cat")?> id=<?php echo $this->get_field_id("selected-cat")?>>
        <?php
        for($i=0;$i<sizeof($fields);$i++){
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
