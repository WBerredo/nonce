<?php

/**
 * Created by PhpStorm.
 * User: berredo
 * Date: 2/25/17
 * Time: 12:43 AM
 */
class NonceTest extends WP_UnitTestCase
{
    private static $DEFAULT_ACTION = "default_action";
    private static $DEFAULT_URL = "https://github.com/WBerredo/nonce";

    private static $DEFALT_KEY_NAME = '_wpnonce';

    /**
     * @var NonceGenerator
     */
    private static $nonceGenerator;

    public static function setUpBeforeClass()
    {
        self::$nonceGenerator = new NonceGenerator();
        self::$nonceGenerator
            ->setAction(self::$DEFAULT_ACTION)
            ->setUrl(self::$DEFAULT_URL);
    }


    public function testGenerateNonceDefaultKeyName()
    {
        $completeUrl = self::$nonceGenerator->generateNonceUrl();

        $queryUrl = parse_url($completeUrl, PHP_URL_QUERY);
        parse_str($queryUrl, $params);

        $this->assertEquals(array_key_exists(self::$DEFALT_KEY_NAME, $params), true);
    }

    public function testGenerateNonceCustomKeyName()
    {
        $customKeyName = "custom";
        $completeUrl = self::$nonceGenerator->generateNonceUrl($customKeyName);

        $queryUrl = parse_url($completeUrl, PHP_URL_QUERY);
        var_dump($queryUrl);
        parse_str($queryUrl, $params);

        $this->assertEquals(array_key_exists($customKeyName, $params), true);
    }
}