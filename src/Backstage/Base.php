<?php

namespace F15DTaboola\Backstage;

use F15DTaboola\Connection\Connection;
use GuzzleHttp\Client;

class Base {
	/** @var Client */
	protected $http;

	protected $types = [];

	/**
	 * Base constructor.
	 *
	 * @param string $type
	 * @param array  $config
	 *
	 * @throws \Exception
	 */
	public function __construct( string $type, $config = [] ) {
		$this->http = Connection::httpAuthFormatedUriS( $type, $config );
	}


	public function getHttpClient() {
		return $this->http;
	}

	public function getHttpConfig( $option = null ) {
		return $this->http->getConfig( $option );
	}
}