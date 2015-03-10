<?php
// File: spec/AppBundle/RequestHandler/ResponseSpec.php

namespace spec\AppBundle\RequestHandler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResponseSpec extends ObjectBehavior
{
    function it_has_a_status_code()
    {
        $this->beConstructedWith(204);

        $this->getStatusCode()->shouldBe(204);
    }

    function it_can_have_headers()
    {
        $this->beConstructedWith(204);
        $this->setHeaders(array('Content-Type' => 'application/json'));

        $this->getHeader('Content-Type')->shouldBe('application/json');
    }

    function it_can_have_a_body()
    {
        $this->beConstructedWith(200);
        $this->setBody('{"wound":"just a flesh one"}');

        $this->getBody()->shouldBe('{"wound":"just a flesh one"}');
    }
}
