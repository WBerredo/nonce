<?php

/**
 * Created by PhpStorm.
 * User: berredo
 * Date: 2/25/17
 * Time: 2:08 AM
 */
class Nonce_Verifier_Test extends WP_UnitTestCase {
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

	public function testVerifyNonce() {
		$nonce = self::$nonce_generator->generate_nonce();

		$this->assertEquals( Nonce_Verifier::verify( $nonce, self::$DEFAULT_ACTION ), true );
	}

	public function testVerifyNonceUrlDefaultKeyName() {
		$complete_url = self::$nonce_generator->generate_nonce_url();

		$verification = Nonce_Verifier::verify_url( $complete_url, self::$DEFAULT_ACTION, self::$DEFAULT_KEY_NAME );
		$this->assertEquals( $verification, true );
	}

	public function testVerifyNonceUrlCustomKeyName() {
		$custom_key_name = "custom25";
		$completeUrl = self::$nonce_generator->generate_nonce_url( $custom_key_name );

		$verification = Nonce_Verifier::verify_url( $completeUrl, self::$DEFAULT_ACTION, $custom_key_name );
		$this->assertEquals( $verification, true );
	}

	public function testNonceField() {
		$nonce_field = self::$nonce_generator->generate_nonce_field();

		$dom = new DOMDocument();
		$dom->loadHTML( $nonce_field );
		$input = $dom->getElementsByTagName( 'input' )->item( 0 );

		$nonce = $input->getAttribute( 'value' );

		$this->assertEquals( Nonce_Verifier::verify( $nonce, self::$DEFAULT_ACTION ), true );
	}

	public function testAdminReferer()
	{
		$nonce = self::$nonce_generator->generate_nonce();

		$_REQUEST[self::$DEFAULT_KEY_NAME] = $nonce;
		$this->assertEquals( Nonce_Verifier::verify_admin_referer( self::$DEFAULT_ACTION ), true );
	}

	public function testAjaxReferer()
	{
		$nonce = self::$nonce_generator->generate_nonce();

		$_REQUEST[self::$DEFAULT_KEY_NAME] = $nonce;
		$this->assertEquals( Nonce_Verifier::verify_ajax_referer( self::$DEFAULT_ACTION ), true );
	}
}