<?php

/**
 * Configurations for Nonces
 *
 * User: berredo
 * Date: 2/25/17
 * Time: 3:14 AM
 */
class Nonce_Config {
	/**
	 * @var int $nonceLifetimeInSeconds
	 */
	private static $nonceLifetimeInSeconds;

	/**
     * Set nonce lifetime in seconds
     *
	 * @var string $nonceErrorMessage
	 */
	private static $nonce_error_message;

	public static function set_nonce_lifetime( $seconds ) {
		self::$nonceLifetimeInSeconds = $seconds;

		add_filter( 'nonce_life', function () {
			return Nonce_Config::$nonceLifetimeInSeconds;
		});
	}

	/**
	 * Set message to be used when the method showAys is called
	 *
	 * @param string $message
	 */
	public static function set_error_message( $message ) {
		self::$nonce_error_message = $message;

		add_filter( 'gettext', function ( $translation ) {
			return self::$nonce_error_message;
		});
	}
}