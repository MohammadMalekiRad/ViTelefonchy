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

	function curlRequest( $url, $token, $data, $post_type = 'GET' ) {
		$url .= '?';
		foreach ( $data as $key => $val ):
			$url .= $key . "=" . $val . "&";
		endforeach;
		$curl = curl_init();
		curl_setopt_array( $curl, array(
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST  => $post_type,
			CURLOPT_HTTPHEADER     => [
				'Webservice-Token: ' . $token
			],
		) );

		$response = curl_exec( $curl );

		curl_close( $curl );

		return $response;
	}
}