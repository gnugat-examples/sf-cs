<?php
// File: src/AppBundle/RequestHandler/Middleware/EventRequestHandler.php

namespace AppBundle\RequestHandler\Middleware;

use AppBundle\RequestHandler\Event\ReceivedResponse;
use AppBundle\RequestHandler\Request;
use AppBundle\RequestHandler\RequestHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventRequestHandler implements RequestHandler
{
    private $eventDispatcher;
    private $requestHandler;

    public function __construct(EventDispatcherInterface $eventDispatcher, RequestHandler $requestHandler)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->requestHandler = $requestHandler;
    }

    public function handle(Request $request)
    {
        $response = $this->requestHandler->handle($request);
        $this->eventDispatcher->dispatch('request_handler.received_response', new ReceivedResponse($response));

        return $response;
    }
}
