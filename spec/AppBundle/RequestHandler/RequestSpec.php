<?php
// File: spec/AppBundle/RequestHandler/RequestSpec.php

namespace spec\AppBundle\RequestHandler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequestSpec extends ObjectBehavior
{
    function it_has_a_verb_and_an_uri()
    {
        $this->beConstructedWith('GET', '/api/v1/profiles');

        $this->getVerb()->shouldBe('GET');
        $this->getUri()->shouldBe('/api/v1/profiles');
    }

    function it_can_have_headers()
    {
        $this->beConstructedWith('GET', '/api/v1/profiles');
        $this->setHeader('Content-Type', 'application/json');

        $this->getHeaders()->shouldBe(array('Content-Type' => 'application/json'));
    }

    function it_can_have_a_body()
    {
        $this->beConstructedWith('GET', '/api/v1/profiles');
        $this->setBody('{"wound":"just a flesh one"}');

        $this->getBody()->shouldBe('{"wound":"just a flesh one"}');
    }
}
