<?php
// spec/AppBundle/RequestHandler/Middleware/GuzzleRequestHandlerSpec.php

namespace spec\AppBundle\RequestHandler\Middleware;

use AppBundle\RequestHandler\Request;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Stream\StreamInterface;
use PhpSpec\ObjectBehavior;

class GuzzleRequestHandlerSpec extends ObjectBehavior
{
    const VERB = 'POST';
    const URI = '/api/v1/profiles';

    const HEADER_NAME = 'Content-Type';
    const HEADER_VALUE = 'application/json';

    const BODY = '{"username":"King Arthur"}';

    function let(ClientInterface $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_a_request_handler()
    {
        $this->shouldImplement('AppBundle\RequestHandler\RequestHandler');
    }

    function it_uses_guzzle_to_do_the_actual_request(
        ClientInterface $client,
        RequestInterface $guzzleRequest,
        ResponseInterface $guzzleResponse,
        StreamInterface $stream
    )
    {
        $request = new Request(self::VERB, self::URI);
        $request->setHeader(self::HEADER_NAME, self::HEADER_VALUE);
        $request->setBody(self::BODY);

        $client->createRequest(self::VERB, self::URI, array(
            'headers' => array(self::HEADER_NAME => self::HEADER_VALUE),
            'body' => self::BODY,
        ))->willReturn($guzzleRequest);
        $client->send($guzzleRequest)->willReturn($guzzleResponse);
        $guzzleResponse->getStatusCode()->willReturn(201);
        $guzzleResponse->getHeaders()->willReturn(array('Content-Type' => 'application/json'));
        $guzzleResponse->getBody()->willReturn($stream);
        $stream->__toString()->willReturn('{"id":42,"username":"King Arthur"}');

        $this->handle($request)->shouldHaveType('AppBundle\RequestHandler\Response');
    }
}
