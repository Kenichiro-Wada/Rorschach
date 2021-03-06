<?php

namespace Rorschach\Assert;

use GuzzleHttp\Psr7\Response;
use Rorschach\Parser;

class HasProperty
{
    private $response;
    private $expect;

    /**
     * HasProperty constructor.
     * @param Response $response
     * @param $expect
     */
    public function __construct(Response $response, $expect)
    {
        $this->response = $response;
        $this->expect = $expect;
    }

    /**
     * @return bool
     */
    public function assert()
    {
        $body = json_decode((string)$this->response->getBody(), true);

        try {
            Parser::search($this->expect, $body);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}