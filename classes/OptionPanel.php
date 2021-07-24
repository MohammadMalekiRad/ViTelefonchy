<?php

namespace ViTelefonchy\classes;

class OptionPanel extends ViSingleton {

	private const VI_TELEFONCHY_OPTIONS = "vi_telefonchy_options";
	const VI_TELEFONCHY_OPTIONS_service_id = "service-id";
	const VI_TELEFONCHY_OPTIONS_webservice = "webservice";

	function init() {
		add_action( 'admin_head', [ $this, 'my_custom_favicon' ] );
		add_action( 'admin_menu', [ $this, 'registerOptionPanel' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'loadCssAndJs' ] );
	}

	function my_custom_favicon() {
		echo '
    <style>
    .dashicons-my-ic {
        background-image: url("' . VI_TELEFONCHY_PLUGIN_ICON . '");
        background-repeat: no-repeat;
        background-position: center; 
    }
    </style>';
	}

	function registerOptionPanel() {

		add_menu_page(
			'تلفنچی',
			'تلفنچی',
			'read',
			'vi-telefonchy',
			[ $this, 'optionsPanelCallback' ],
			'dashicons-my-ic'
		);

		add_submenu_page( 'vi-telefonchy',
			'تنظیمات',
			'تنظیمات',
			'read',
			'vi-telefonchy-opt',
			[ $this, 'telefonchyOptCallback' ] );
	}

	function optionsPanelCallback() {
		$pagenum = 1;
		if ( isset( $_GET['pagenum'] ) ) {
			$pagenum = intval( $_GET['pagenum'] );
		}
		$calls = RequestHandler::getCalls( self::getWebservice(),
			[
				'service_id' => self::getServiceId(),
				'page'       => $pagenum
			]
		);
		if ( isset( $calls ) ) {
			$calls = json_decode( $calls, true );
		} else {
			$calls = [];
		}

		ViewRenderHelper::renderView( 'calls-list', $calls );
	}

	function loadCssAndJs() {
		wp_enqueue_script(
			"vi-telefonchy-bootstrap",
			VI_TELEFONCHY_PLUGIN_URL . "assets/bootstrap.bundle.min.js" );
		wp_enqueue_style(
			"vi-telefonchy-bootstrap",
			VI_TELEFONCHY_PLUGIN_URL . "assets/bootstrap.rtl.min.css" );
	}

	function telefonchyOptCallback() {
		if ( isset( $_POST['vi-telefonchy-service-id'], $_POST['vi-telefonchy-webservice'] ) ) {
			update_option( self::VI_TELEFONCHY_OPTIONS, [
				self::VI_TELEFONCHY_OPTIONS_service_id => sanitize_text_field( $_POST['vi-telefonchy-service-id'] ),
				self::VI_TELEFONCHY_OPTIONS_webservice => sanitize_text_field( $_POST['vi-telefonchy-webservice'] )
			] );
		}
		$service = RequestHandler::getService( self::getWebservice(), [ 'service_id' => self::getServiceId() ] );
		if ( isset( $service ) ) {
			$service = json_decode( $service, true );
		}
		$data[] = self::getOptions();
		$data[] = $service;

		ViewRenderHelper::renderView( 'option-panel', $data );
	}

	public static function getOptions( $key = null ) {
		$opt = get_option( self::VI_TELEFONCHY_OPTIONS );
		if ( ! is_null( $key ) && isset( $opt[ $key ] ) ) {
			return $opt[ $key ];
		}

		return $opt ?? false;
	}

	public static function getWebservice() {
		return self::getOptions( self::VI_TELEFONCHY_OPTIONS_webservice ) ?? '';
	}

	public static function getServiceId() {
		return self::getOptions( self::VI_TELEFONCHY_OPTIONS_service_id ) ?? '';
	}
}