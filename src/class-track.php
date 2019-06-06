<?php

namespace Tsquare\ErrorTracker;

class Track {

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'track' ), -1000 );
		add_action( 'wp_enqueue_scripts', array( $this, 'logrocket' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'logrocket' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'sentry_js' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'sentry_js' ) );
	}

	public function track() {
		self::sentry_php();
	}

	public function sentry_php() {
		if ( get_option( 'et_sentry_php' ) ) {
			require_once ERROR_TRACKER_DIR . '/vendor/sentry/lib/Raven/Autoloader.php';
			\Raven_Autoloader::register();
			$client        = new \Raven_Client( get_option( 'et_sentry_php' ) );
			$error_handler = new \Raven_ErrorHandler( $client );
			$error_handler->registerExceptionHandler();
			$error_handler->registerErrorHandler();
			$error_handler->registerShutdownFunction();
			$client->user_context(
				array(
					'site' => site_url(),
				)
			);
		}
	}

	public function sentry_js() {
		if ( get_option( 'et_sentry_js' ) ) {
			wp_enqueue_script( 'sentry-js', 'https://browser.sentry-cdn.com/4.4.2/bundle.min.js' );
			$script = 'Sentry.init({ dsn: "' . get_option( 'et_sentry_js' ) . '" });';
			wp_add_inline_script( 'sentry-js', $script );
		}
	}

	public function logrocket() {
		if ( get_option( 'et_logrocket' ) ) {
			wp_enqueue_script( 'logrocket-js', 'https://cdn.logrocket.io/LogRocket.min.js' );
			$script = 'window.LogRocket && window.LogRocket.init("' . get_option( 'et_logrocket' ) . '");';
			wp_add_inline_script( 'logrocket-js', $script );
		}
	}
}
