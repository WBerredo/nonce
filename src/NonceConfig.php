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
    private static $nonceLifetimeInSeconds;
    private static $nonceErrorMessage;

    public static function setNonceLifetime($seconds) {
        self::$nonceLifetimeInSeconds = $seconds;

        add_filter( 'nonce_life',  function () { return NonceConfig::$nonceLifetimeInSeconds; });
    }

    public static function setErrorMessage($message) {
        self::$nonceErrorMessage = $message;

        add_filter('gettext', function($translation) { return self::$nonceErrorMessage; });
    }
}