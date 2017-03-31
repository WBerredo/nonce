<?php

/**
 * Generator for Wordpress Nonces
 * User: berredo
 * Date: 2/25/17
 * Time: 1:14 AM
 */
class NonceGenerator
{
	/**
	 * @var $action
	 */
	protected $action;

	/**
	 * @var $url
	 */
	protected $url;

	public static $defaultParamName;

	/**
	 * Nonce constructor.
	 *
	 * @param $action
	 */
	public function __construct($action = -1)
	{
		$this->action = $action;
	}

	/**
	 * set action to generate nonces
	 *
	 * @param string $action
	 *
	 * @return $this
	 */
	public function setAction($action)
	{
		$this->action = $action;

		return $this;
	}

	/**
	 * set url to generate nonce url
	 *
	 * @param $url
	 *
	 * @return $this
	 */
	public function setUrl($url)
	{
		$this->url = $url;

		return $this;
	}

	/**
	 * Retrieves a nonce url
	 *
	 * @param string (optional) $keyName . Nonce param name. Default is _wpnonce
	 *
	 * @return string
	 */
	public function generateNonceUrl($keyName = '_wpnonce')
	{
		if (!$this->url) return null;

		return wp_nonce_url($this->url, $this->action, $keyName);
	}

	/**
	 * Retrieves the nonce hidden form field.
	 *
	 * @param string $name
	 * @param bool   $referer
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public function generateNonceField($name = '_wpnonce', $referer = true, $echo = false)
	{
		return wp_nonce_field($this->action, $name, $referer, $echo);
	}

	/**
	 * Retrieves a general nonce
	 *
	 * @return string
	 */
	public function generateNonce()
	{
		return wp_create_nonce($this->action);
	}

	/**
	 * Retrieves or displays the referer hidden form field.
	 *
	 * @param $echo
	 *
	 * @return string
	 */
	public function generateRefererField($echo)
	{
		return wp_referer_field($echo);
	}

	/**
	 * Display 'Are you sure you want to do this?' message to confirm the action being taken.
	 *
	 * @param $action
	 */
	public static function showAys($action)
	{
		wp_nonce_ays($action);
	}
}