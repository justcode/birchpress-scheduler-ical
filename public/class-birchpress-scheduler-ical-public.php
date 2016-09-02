<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://justcode.co
 * @since      1.0.0
 *
 * @package    Birchpress_Scheduler_Ical
 * @subpackage Birchpress_Scheduler_Ical/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Birchpress_Scheduler_Ical
 * @subpackage Birchpress_Scheduler_Ical/public
 * @author     Aaron Alexander <aaron@justcode.co>
 */
class Birchpress_Scheduler_Ical_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Birchpress_Scheduler_Ical_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Birchpress_Scheduler_Ical_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/birchpress-scheduler-ical-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Birchpress_Scheduler_Ical_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Birchpress_Scheduler_Ical_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/birchpress-scheduler-ical-public.js', array( 'jquery' ), $this->version, false );

	}

	function bps_ical_template_redirect() {
		$request_uri = strtok($_SERVER["REQUEST_URI"],'?');
	  if ($request_uri=='/scheduler/ical' && isset($_REQUEST['appointment'])) {
			$appointment_id = $_REQUEST['appointment'];
			$filename='appointment.ics';
			global $birchschedule;
			$appointment1on1 = $birchschedule->model->mergefields->get_appointment1on1_merge_values($appointment_id);
			if (!isset($appointment1on1['_birs_appointment_id'])) {
				return false;
			}
			$begin_timestamp = $appointment1on1['_birs_appointment_timestamp'];
			$duration = (int) $appointment1on1['_birs_appointment_duration'];
			$duration = $duration*60;
			$end_timestamp = $begin_timestamp + $duration;
			$staff_name = $appointment1on1['_birs_staff_name'];
			$service_name = $appointment1on1['_birs_service_name'];
			$address = $appointment1on1['_birs_location_name']." ".$appointment1on1['_birs_location_address1']." ".$appointment1on1['_birs_location_address2']." ".$appointment1on1['_birs_location_city'].', '.$appointment1on1['_birs_location_state'].' '.$appointment1on1['_birs_location_zip'];
			$summary=$this->escapeString("$service_name with $staff_name");
			$datestart=$this->dateToCal($begin_timestamp);
			$dateend=$this->dateToCal($end_timestamp);
			$address=$this->escapeString($address);
			$description=$this->escapeString("$service_name with $staff_name");
			$uid = uniqid();
			$timestamp = $this->dateToCal(time());
			header('Content-type: text/calendar; charset=utf-8',true,200);
			header('Content-Disposition: inline; filename=' . $filename);
$data = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//hacksw/handcal//NONSGML v1.0//EN
CALSCALE:GREGORIAN
BEGIN:VEVENT
DTEND:$dateend
UID:$uid
DTSTAMP:$timestamp
LOCATION:$address
DESCRIPTION:$description
SUMMARY:$summary
DTSTART:$datestart
END:VEVENT
END:VCALENDAR";
			echo $data;
	    exit();
	  }
	}

	public function dateToCal($timestamp) {
  	return date('Ymd\THis\Z', $timestamp);
	}

	public function escapeString($string) {
	  return preg_replace('/([\,;])/','\\\$1', $string);
	}
}
