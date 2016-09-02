<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://justcode.co
 * @since             1.0.0
 * @package           Birchpress_Scheduler_Ical
 *
 * @wordpress-plugin
 * Plugin Name:       BirchPress Scheduler iCal File Generator
 * Plugin URI:        https://github.com/justcode/birchpress-scheduler-ical
 * Description:       Generates an iCal file for a specific Birchpress Scheduler event.
 * Version:           1.0.0
 * Author:            Aaron Alexander
 * Author URI:        https://justcode.co
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       birchpress-scheduler-ical
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-birchpress-scheduler-ical-activator.php
 */
function activate_birchpress_scheduler_ical() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-birchpress-scheduler-ical-activator.php';
	Birchpress_Scheduler_Ical_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-birchpress-scheduler-ical-deactivator.php
 */
function deactivate_birchpress_scheduler_ical() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-birchpress-scheduler-ical-deactivator.php';
	Birchpress_Scheduler_Ical_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_birchpress_scheduler_ical' );
register_deactivation_hook( __FILE__, 'deactivate_birchpress_scheduler_ical' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-birchpress-scheduler-ical.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_birchpress_scheduler_ical() {

	$plugin = new Birchpress_Scheduler_Ical();
	$plugin->run();

}
run_birchpress_scheduler_ical();
