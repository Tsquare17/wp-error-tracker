<?php
/**
 * Error Tracker
 *
 * @package     Tsquare\ErrorTracker
 * @author      Trevor Thompson
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Error Tracker
 * Description: Integrate LogRocket and/or Sentry error tracking solutions with WordPress.
 * Version:     1.0.0
 * Author:      Trevor Thompson
 * Author URI:  https://trevor-thompson.com/
 * Text Domain: error_tracker
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace Tsquare\ErrorTracker;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'No' );
}

define( 'ERROR_TRACKER_DIR', plugin_dir_path( __FILE__ ) );

include( 'src/class-settings.php' );
include( 'src/class-track.php' );

$config = new Settings;
$errors = new Track;
