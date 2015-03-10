<?php
// File: src/AppBundle/RequestHandler/Request.php

namespace AppBundle\RequestHandler;

class Request
{
    private $verb;
    private $uri;

    public function __construct($verb, $uri)
    {
        $this->verb = $verb;
        $this->uri = $uri;
    }

    public function getVerb()
    {
        return $this->verb;
    }

    public function getUri()
    {
        return $this->uri;
    }
}
