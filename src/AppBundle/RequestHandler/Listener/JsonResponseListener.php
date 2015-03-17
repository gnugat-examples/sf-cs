<?php
// File: src/AppBundle/RequestHandler/Listener/JsonResponseListener.php

namespace AppBundle\RequestHandler\Listener;

use AppBundle\RequestHandler\Event\ReceivedResponse;
use Exception;

class JsonResponseListener
{
    public function onReceivedResponse(ReceivedResponse $receivedResponse)
    {
        $response = $receivedResponse->getResponse();
        $contentType = $response->getHeader('Content-Type');
        if (false === strpos($response->getHeader('Content-Type'), 'application/json')) {
            return;
        }
        $body = $response->getBody();
        $json = json_decode($body, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new Exception("Invalid JSON: $body");
        }
        $response->setBody($json);
    }
}
