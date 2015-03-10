<?php
// File: src/AppBundle/RequestHandler/Response.php

namespace AppBundle\RequestHandler;

class Response
{
    private $statusCode;

    public function __construct($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
