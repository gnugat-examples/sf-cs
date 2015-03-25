<?php
// File: src/AppBundle/Profile/ProfileGateway.php

namespace AppBundle\Profile;

use AppBundle\RequestHandler\Request;
use AppBundle\RequestHandler\RequestHandler;

class ProfileGateway
{
    private $requestHandler;
    private $url;
    private $username;
    private $password;

    public function __construct(RequestHandler $requestHandler, $url, $username, $password)
    {
        $this->requestHandler = $requestHandler;
        $this->username = $username;
        $this->password = $password;
        $this->url = $url;
    }

    public function create($name)
    {
        $request = new Request('POST', $this->url.'/api/v1/profiles');
        $request->setHeader('Authorization', 'Basic '.base64_encode($this->username.':'.$this->password));
        $request->setHeader('Content-Type', 'application/json');
        $request->setBody(json_encode(array('name' => $name)));

        $response = $this->requestHandler->handle($request);

        return $response->getBody();
    }
}
