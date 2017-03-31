<?php

/**
 * Created by PhpStorm.
 * User: berredo
 * Date: 2/25/17
 * Time: 2:08 AM
 */
class NonceVerifierTest extends WP_UnitTestCase {
	private static $DEFAULT_ACTION   = 'default_action';
	private static $DEFAULT_URL      = 'https://github.com/WBerredo/nonce';

	private static $DEFAULT_KEY_NAME = '_wpnonce';

	/**
	 * @var NonceGenerator
	 */
	private static $nonceGenerator;

	public static function setUpBeforeClass() {
		self::$nonceGenerator = new NonceGenerator();
		self::$nonceGenerator
			->setAction( self::$DEFAULT_ACTION )
			->setUrl( self::$DEFAULT_URL );
	}

	public function testVerifyNonce() {
		$nonce = self::$nonceGenerator->generateNonce();

		$this->assertEquals( NonceVerifier::verify( $nonce, self::$DEFAULT_ACTION ), true );
	}

	public function testVerifyNonceUrlDefaultKeyName() {
		$completeUrl = self::$nonceGenerator->generateNonceUrl();

		$verification = NonceVerifier::verifyUrl( $completeUrl, self::$DEFAULT_ACTION, self::$DEFAULT_KEY_NAME );
		$this->assertEquals( $verification, true );
	}

	public function testVerifyNonceUrlCustomKeyName() {
		$customKeyName = "custom25";
		$completeUrl = self::$nonceGenerator->generateNonceUrl( $customKeyName );

		$verification = NonceVerifier::verifyUrl( $completeUrl, self::$DEFAULT_ACTION, $customKeyName );
		$this->assertEquals( $verification, true );
	}

	public function testNonceField() {
		$nonceField = self::$nonceGenerator->generateNonceField();

		$dom = new DOMDocument();
		$dom->loadHTML($nonceField);
		$input = $dom->getElementsByTagName( 'input' )->item( 0 );

		$nonce = $input->getAttribute( 'value' );

		$this->assertEquals( NonceVerifier::verify( $nonce, self::$DEFAULT_ACTION ), true );
	}

	public function testAdminReferer()
	{
		$nonce = self::$nonceGenerator->generateNonce();

		$_REQUEST[self::$DEFAULT_KEY_NAME] = $nonce;
		$this->assertEquals( NonceVerifier::verifyAdminReferer( self::$DEFAULT_ACTION ), true );
	}

	public function testAjaxReferer()
	{
		$nonce = self::$nonceGenerator->generateNonce();

		$_REQUEST[self::$DEFAULT_KEY_NAME] = $nonce;
		$this->assertEquals( NonceVerifier::verifyAjaxReferer( self::$DEFAULT_ACTION ), true );
	}
}