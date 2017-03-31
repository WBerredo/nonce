<?php

/**
 * Verifier for Wordpress Nonces
 * User: berredo
 * Date: 2/25/17
 * Time: 1:28 AM
 */
class Nonce_Verifier {
	/**
	 * Verify nonce
	 *
	 * @param $nonce
	 * @param $action
	 *
	 * @return boolean
	 */
	public static function verify( $nonce, $action = -1 ) {
		return wp_verify_nonce( $nonce, $action );
	}

	/**
	 * Verify a nonce in a url
	 *
	 * @param $nonceUrl
	 * @param $action
	 * @param $keyName
	 *
	 * @return boolean
	 */
	public static function verify_url($nonceUrl, $action = -1, $keyName )	{
		$queryUrl = parse_url( $nonceUrl, PHP_URL_QUERY );
		parse_str( $queryUrl, $params );

		return self::verify( $params[$keyName], $action );
	}

	/**
	 *Tests either if the current request carries a valid nonce,
	 * or if the current request was referred from an administration screen
	 *
	 * @param int    $action
	 * @param string $keyName
	 *
	 * @return false|int
	 */
	public static function verify_admin_referer($action = -1, $keyName = '_wpnonce' )
	{
		return check_admin_referer( $action, $keyName );
	}


	/**
	 * Verifies the AJAX request, to prevent any processing of
	 * requests which are passed in by third-party sites or systems.
	 *
	 * @param int    $action
	 * @param string $keyName
	 *
	 * @return false|int
	 */
	public static function verify_ajax_referer($action = -1, $keyName = '_wpnonce' )
	{
		return check_ajax_referer( $action, $keyName );
	}
}