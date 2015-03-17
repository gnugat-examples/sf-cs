<?php
// src: spec/AppBundle/RequestHandler/Listener/JsonResponseListenerSpec.php

namespace spec\AppBundle\RequestHandler\Listener;

use AppBundle\RequestHandler\Event\ReceivedResponse;
use AppBundle\RequestHandler\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonResponseListenerSpec extends ObjectBehavior
{
    function it_handles_json_response(ReceivedResponse $receivedResponse, Response $response)
    {
        $receivedResponse->getResponse()->willReturn($response);
        $response->getHeader('Content-Type')->willReturn('application/json');
        $response->getBody()->willReturn('{"data":[]}');
        $response->setBody(array('data' => array()))->shouldBeCalled();

        $this->onReceivedResponse($receivedResponse);
    }

    function it_does_not_handle_non_json_response(ReceivedResponse $receivedResponse, Response $response)
    {
        $receivedResponse->getResponse()->willReturn($response);
        $response->getHeader('Content-Type')->willReturn('text/html');
        $response->getBody()->shouldNotBeCalled();

        $this->onReceivedResponse($receivedResponse);
    }

    function it_fails_to_handle_invalid_json(ReceivedResponse $receivedResponse, Response $response)
    {
        $receivedResponse->getResponse()->willReturn($response);
        $response->getHeader('Content-Type')->willReturn('application/json');
        $response->getBody()->willReturn('{"data":[');

        $exception = 'Exception';
        $this->shouldThrow($exception)->duringOnReceivedResponse($receivedResponse);
    }
}
