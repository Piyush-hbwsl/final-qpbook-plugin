<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/Piyush-hbwsl
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wp_Book
 * @subpackage Wp_Book/includes
 * @author     Piyush Agarwal <piyushagarwal1820@gmail.com>
 */
class Wp_Book_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		// global $wpdb;
		// $table_name = $wpdb->prefix . 'bookmeta';
		// $wpdb->query("DROP TABLE IF EXISTS $table_name")
	}

}
