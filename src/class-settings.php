<?php

namespace Tsquare\ErrorTracker;

class Settings {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'options' ) );
	}

	public function options() {

		add_settings_section( 'et_settings_group', '', null, 'errortracker-options' );

		add_settings_field(
			'et_logrocket',
			'LogRocket App ID',
			array( $this, 'logrocket' ),
			'errortracker-options',
			'et_settings_group',
			array(
				'label_for' => 'et_logrocket',
				'class'     => 'et-field',
			)
		);
		register_setting( 'et_settings_group', 'et_logrocket' );

		add_settings_field(
			'et_sentry_php',
			'Sentry PHP Client Key',
			array( $this, 'sentry_php' ),
			'errortracker-options',
			'et_settings_group',
			array(
				'label_for' => 'et_sentry_php',
				'class'     => 'et-field',
			)
		);
		register_setting( 'et_settings_group', 'et_sentry_php' );

		add_settings_field(
			'et_sentry_js',
			'Sentry JS Client Key',
			array( $this, 'sentry_js' ),
			'errortracker-options',
			'et_settings_group',
			array(
				'label_for' => 'et_sentry_js',
				'class'     => 'et-field',
			)
		);
		register_setting( 'et_settings_group', 'et_sentry_js' );

		add_menu_page( 'Error Tracker', 'Error Tracker', 'manage_options', 'errortracker-options', array( $this, 'errortracker_options' ), 'dashicons-warning' );
	}

	public function errortracker_options() {
		?>
		<div>
		<h2>Error Tracker</h2>
		<form method="post" action="options.php">
			<?php settings_fields( 'et_settings_group' ); ?>
		<table>
		<tr valign="top">
			<?php do_settings_sections( 'errortracker-options' ); ?>
		</tr>
		</table>
			<?php submit_button(); ?>
		</form>
		</div>
		<?php
	}

	public function logrocket() {
		echo '<input type="text" id="et_logrocket" class="form-settings-field" name="et_logrocket" value="';
		if ( get_option( 'et_logrocket' ) ) {
			echo get_option( 'et_logrocket' );
			echo '" placeholder="' . get_option( 'et_logrocket' );
		}
		echo '"/>';
	}

	public function sentry_php() {
		echo '<input type="text" id="et_sentry_php" class="form-settings-field" name="et_sentry_php" value="';
		if ( get_option( 'et_sentry_php' ) ) {
			echo get_option( 'et_sentry_php' );
			echo '" placeholder="' . get_option( 'et_sentry_php' );
		}
		echo '"/>';
	}

	public function sentry_js() {
		echo '<input type="text" id="et_sentry_js" class="form-settings-field" name="et_sentry_js" value="';
		if ( get_option( 'et_sentry_js' ) ) {
			echo get_option( 'et_sentry_js' );
			echo '" placeholder="' . get_option( 'et_sentry_js' );
		}
		echo '"/>';
	}

}
