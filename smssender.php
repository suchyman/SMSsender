<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              suchyman.cloud
 * @since             1.0.0
 * @package           Smssender
 *
 * @wordpress-plugin
 * Plugin Name:       SMSsender
 * Plugin URI:        suchyman.cloud
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Suchyman
 * Author URI:        suchyman.cloud
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       smssender
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SMSSENDER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-smssender-activator.php
 */
function activate_smssender() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-smssender-activator.php';
	Smssender_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-smssender-deactivator.php
 */
function deactivate_smssender() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-smssender-deactivator.php';
	Smssender_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_smssender' );
register_deactivation_hook( __FILE__, 'deactivate_smssender' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-smssender.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_smssender() {

	$plugin = new Smssender();
	$plugin->run();

}
run_smssender();


function register_custom_menu_page() {
	add_menu_page('custom menu title', 'Send SMS', 'add_users', 'custompage', '_custom_menu_page', null, 6);
  }
  add_action('admin_menu', 'register_custom_menu_page');

  function _custom_menu_page(){
  echo '<div class="wrap">';
  echo '<h1>Wyślij SMS</h1>';
  echo '<p>';
  echo '  ';
  if (!isset($_FILES['file'])) {
	echo '<h2>Wysyłka SMS</h2>
	<form method="post" enctype="multipart/form-data">
	*.XLSX

	<div class="formradio"><div class=radioses>';
			global $wpdb;
			$args = array(
				'post_type' => 'sms'
			  );
			$the_query = new WP_Query( $args );

			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
			$the_query->the_post();
			echo '<input type="radio" class="radio" name="radio" id="radio" value="' . get_the_title() . '" checked> ' . get_the_title() . '<br>';
		}
		echo '</div>';
	} else {
	  echo 'proszę o uzupełnienie treści SMS w panelu konfiguracyjnym - SMS Sender';
	}
	echo '
	<input type="file" name="file"  />&nbsp;&nbsp;<input type="submit" value="Załaduj plik i wyślij wiadomości" />
	';



	echo '</form>';
	}

  echo '</p>';
  echo '</div>';
  }

require_once __DIR__.'/includes/cpt.php';

require_once __DIR__.'/includes/simplexlsx-master/src/SimpleXLSX.php';


if (isset($_FILES['file'])) {

	if ( $xlsx = SimpleXLSX::parse( $_FILES['file']['tmp_name'] ) ) {



		$wyb = $_POST['radio'];
		$tels='';
		for ($x = 8; $x <= 100; $x++) {

			$telno = $xlsx->getCell(0,'Y'.$x);
			 if ($telno > 0){
			echo 'The number is: ' . $telno . ' z tekstem: ' . $wyb . '<br>';
				$tels .= $telno .',';


			 }
		}
$telefony = substr($tels,0,-1);
echo '<hr>' . $telefony . '<hr>';
		function sms_send($params, $token, $backup = false)
			{

				static $content;

				if ($backup == true) {
					$url = 'https://api2.smsapi.pl/sms.do';
				} else {
					$url = 'https://api.smsapi.pl/sms.do';
				}

				$c = curl_init();
				curl_setopt($c, CURLOPT_URL, $url);
				curl_setopt($c, CURLOPT_POST, true);
				curl_setopt($c, CURLOPT_POSTFIELDS, $params);
				curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($c, CURLOPT_HTTPHEADER, array(
					"Authorization: Bearer $token"
				));

				$content = curl_exec($c);
				$http_status = curl_getinfo($c, CURLINFO_HTTP_CODE);

				if ($http_status != 200 && $backup == false) {
					$backup = true;
					sms_send($params, $token, $backup);
				}

				curl_close($c);
				return $content;
			}
			$tokenSMS = get_option( 'tokensms' );
			$token = '';

			$params = array(
				'to' => $telefony,
				'from' => 'Info',
				'message' => $wyb
			);
			sms_send($params, $token);

		echo '<hr></div></p>';

	} else {
		echo SimpleXLSX::parseError();
	}
}
