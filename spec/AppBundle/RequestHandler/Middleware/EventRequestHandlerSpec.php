<?php
// File: spec/AppBundle/RequestHandler/Middleware/EventRequestHandlerSpec.php

namespace spec\AppBundle\RequestHandler\Middleware;

use AppBundle\RequestHandler\Request;
use AppBundle\RequestHandler\RequestHandler;
use AppBundle\RequestHandler\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventRequestHandlerSpec extends ObjectBehavior
{
    function let(EventDispatcherInterface $eventDispatcher, RequestHandler $requestHandler)
    {
        $this->beConstructedWith($eventDispatcher, $requestHandler);
    }

    function it_is_a_request_handler()
    {
        $this->shouldImplement('AppBundle\RequestHandler\RequestHandler');
    }

    function it_dispatches_events(
        EventDispatcherInterface $eventDispatcher,
        Request $request,
        RequestHandler $requestHandler,
        Response $response
    )
    {
        $requestHandler->handle($request)->willReturn($response);
        $receivedResponse = Argument::type('AppBundle\RequestHandler\Event\ReceivedResponse');
        $eventDispatcher->dispatch('request_handler.received_response', $receivedResponse)->shouldBeCalled();

        $this->handle($request)->shouldBe($response);
    }
}
