<?php
// File: src/AppBundle/RequestHandler/Middleware/GuzzleRequestHandler.php

namespace AppBundle\RequestHandler\Middleware;

use AppBundle\RequestHandler\Request;
use AppBundle\RequestHandler\RequestHandler;
use AppBundle\RequestHandler\Response;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Stream\StreamInterface;

class GuzzleRequestHandler implements RequestHandler
{
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle(Request $request)
    {
        $guzzleRequest = $this->client->createRequest($request->getVerb(), $request->getUri(), array(
            'headers' => $request->getHeaders(),
            'body' => $request->getBody(),
        ));
        $guzzleResponse = $this->client->send($guzzleRequest);
        $response = new Response($guzzleResponse->getStatusCode());
        $response->setHeaders($guzzleResponse->getHeaders());
        $response->setBody($guzzleResponse->getBody()->__toString());

        return $response;
    }
}
