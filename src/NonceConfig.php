<?php

/**
 * Configurations for Nonces
 *
 * User: berredo
 * Date: 2/25/17
 * Time: 3:14 AM
 */
class NonceConfig
{
	/**
	 * @var int $nonceLifetimeInSeconds
	 */
	private static $nonceLifetimeInSeconds;

	/**
	 * @var string $nonceErrorMessage
	 */
	private static $nonceErrorMessage;

	public static function setNonceLifetime($seconds)
	{
		self::$nonceLifetimeInSeconds = $seconds;

		add_filter('nonce_life', function () {
			return NonceConfig::$nonceLifetimeInSeconds;
		});
	}

	/**
	 * Set message to be used when the method showAys is called
	 *
	 * @param string $message
	 */
	public static function setErrorMessage($message)
	{
		self::$nonceErrorMessage = $message;

		add_filter('gettext', function ($translation) {
			return self::$nonceErrorMessage;
		});
	}
}