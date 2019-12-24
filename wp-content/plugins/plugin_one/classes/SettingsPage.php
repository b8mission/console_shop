<?php

class SettingsPage {
	function __construct() {

		add_action( 'admin_init', [ $this, 'plugin_one_settings_init' ] );

		add_action( 'admin_menu', [$this,'plugin_one_options_page']);

	}

	function plugin_one_options_page() {
		// add top level menu page
		add_menu_page(
			'Plugin_One Settings',
			'P1 Settings',
			'manage_options',
			'plugin_one_settings',
			[ $this, 'plugin_one_options_page_html' ]
		);
	}

	function plugin_one_field_pill_cb( $args ) {

		$options = get_option( 'plugin_one_options' );
		?>

        <input value="<?= $options[ 'api_key'] ?? '' ?>" name='plugin_one_options[api_key]' type="text" placeholder="Your API Key . . ."><br>

		<?php
	}

	function plugin_one_settings_init() {
		register_setting( 'plugin_one', 'plugin_one_options' );

		add_settings_section(
			'plugin_one_section_developers',
			__( 'Section 1.', 'plugin_one' ),
			[ $this, 'plugin_one_section_developers_cb' ],
			'plugin_one'
		);

		add_settings_field(
			'plugin_one_field_pill',
			__( 'Api Key', 'plugin_one' ),
			[$this,'plugin_one_field_pill_cb'],
			'plugin_one',
			'plugin_one_section_developers',
			[
				'label_for'         => 'plugin_one_field_pill',
				'class'             => 'plugin_one_row',
				'plugin_one_custom_data' => 'custom',
			]
		);
	}

	function plugin_one_section_developers_cb( $args ) {
		?>

		<?php
	}

	function plugin_one_options_page_html() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( isset( $_GET['settings-updated'] ) ) {
			add_settings_error( 'plugin_one_messages', 'plugin_one_message', __( 'Settings Saved', 'plugin_one' ), 'updated' );
		}

		settings_errors( 'plugin_one_messages' );
		?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <form action="options.php" method="post">
				<?php
				settings_fields( 'plugin_one' );
				do_settings_sections( 'plugin_one' );
				submit_button( 'Save Settings' );
				?>
            </form>
        </div>
		<?php
	}
}
