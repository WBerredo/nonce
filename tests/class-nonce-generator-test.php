<?php

/**
 * Created by PhpStorm.
 * User: berredo
 * Date: 2/25/17
 * Time: 12:43 AM
 */
class Nonce_Generator_Test extends WP_UnitTestCase {
	private static $DEFAULT_ACTION   = 'default_action';
	private static $DEFAULT_URL      = 'https://github.com/WBerredo/nonce';

	private static $DEFAULT_KEY_NAME = '_wpnonce';

	/**
	 * @var Nonce_Generator
	 */
	private static $nonce_generator;

	public static function setUpBeforeClass() {
		self::$nonce_generator = new Nonce_Generator();
		self::$nonce_generator
			->set_action( self::$DEFAULT_ACTION )
			->set_url( self::$DEFAULT_URL );
	}

	public function test_generate_nonce_url_default_key_name() {
		$complete_url = self::$nonce_generator->generate_nonce_url();

		$query_url = parse_url( $complete_url, PHP_URL_QUERY );
		parse_str( $query_url, $params );

		$this->assertTrue( array_key_exists( self::$DEFAULT_KEY_NAME, $params ) );
	}

	public function test_generate_nonce_url_custom_key_name()	{
		$custom_key_name = 'custom';
		$complete_url = self::$nonce_generator->generate_nonce_url( $custom_key_name );

		$query_url = parse_url( $complete_url, PHP_URL_QUERY );
		parse_str( $query_url, $params );

		$this->assertTrue( array_key_exists( $custom_key_name, $params ) );
	}

	public function test_generate_nonce()	{
		$nonce = self::$nonce_generator->generate_nonce();

		$this->assertNotNull( $nonce );
	}
}