<?php
// File: src/AppBundle/RequestHandler/Request.php

namespace AppBundle\RequestHandler;

class Request
{
    private $verb;
    private $uri;
    private $headers = array();

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

    public function setHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

    public function getHeaders()
    {
        return $this->headers;
    }
}
