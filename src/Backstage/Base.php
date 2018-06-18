<?php

namespace F15DTaboola\Backstage;

use F15DTaboola\Connection\Connection;
use GuzzleHttp\Client;

class Base
{
    /** @var Client */
    protected $http;

    protected $types = [];

    /**
     * Base constructor.
     * @param $type
     * @throws \Exception
     */
    public function __construct(string $type)
    {
        $this->http = Connection::httpAuthFormatedUriS($type);
    }

    public function getHttpClient()
    {
        return $this->http;
    }

    public function getHttpConfig($option = null)
    {
        return $this->http->getConfig($option);
    }
}