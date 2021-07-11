<?php


namespace ViTelefonchy\classes;


use Elementor\daste;

class RequestHandler extends ViSingleton {

	// urls
	private const BASE_URL = 'https://telefonchy.com/webservice/v1/';
	private const SERVICE_URL = self::BASE_URL . 'services'; // get
	private const CALLS_URL = self::BASE_URL . 'calls'; //get

	function init() {

	}

	public static function getCalls( $token, $data ) {
		return RequestHandler::getInstance()->curlRequest( self::CALLS_URL, $token, $data );
	}

	public static function getService( $token, $data ) {
		return RequestHandler::getInstance()->curlRequest( self::SERVICE_URL, $token, $data );
	}

	/**
	 * @param $url
	 * @param $token
	 * @param $data
	 *
	 * @return string
	 */
	function curlRequest( $url, $token, $data ): string {
		$url .= '?';
		foreach ( $data as $key => $val ):
			$url .= $key . "=" . $val . "&";
		endforeach;
		$args     = array(
			'timeout' => '50000',
			'headers' => array(
				'Webservice-Token' => $token
			)
		);
		$response = wp_remote_get( $url, $args );
		$body     = wp_remote_retrieve_body( $response );

		return $body;
	}
}