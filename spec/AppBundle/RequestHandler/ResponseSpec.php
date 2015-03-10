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
}
