<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://justcode.co
 * @since      1.0.0
 *
 * @package    Birchpress_Scheduler_Ical
 * @subpackage Birchpress_Scheduler_Ical/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Birchpress_Scheduler_Ical
 * @subpackage Birchpress_Scheduler_Ical/includes
 * @author     Aaron Alexander <aaron@justcode.co>
 */
class Birchpress_Scheduler_Ical_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'birchpress-scheduler-ical',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
