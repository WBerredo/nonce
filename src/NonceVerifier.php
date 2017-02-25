<?php

/**
 * Created by PhpStorm.
 * User: berredo
 * Date: 2/25/17
 * Time: 1:28 AM
 */
class NonceVerifier
{
    /**
     * @param $nonce
     * @param $action
     *
     * @return boolean
     */
    public static function verify($nonce, $action = -1)
    {
        return wp_verify_nonce($nonce, $action);
    }

    /**
     * @param $nonceUrl
     * @param $action
     * @param $paramName
     *
     * @return boolean
     */
    public static function verifyUrl($nonceUrl, $action = -1, $paramName)
    {
        $queryUrl = parse_url($nonceUrl, PHP_URL_QUERY);
        parse_str($queryUrl, $params);

        return self::verify($params[$paramName], $action);
    }


}