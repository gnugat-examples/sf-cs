<?php
// File: tests/Command/CreateProfileCommandTest.php

namespace AppBundle\Tests\Command;

use PHPUnit_Framework_TestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\Console\Input\ArrayInput;

class CreateProfileCommandTest extends PHPUnit_Framework_TestCase
{
    private $app;
    private $output;

    protected function setUp()
    {
        $kernel = new \AppKernel('test', false);
        $this->app = new Application($kernel);
        $this->app->setAutoExit(false);
        $this->output = new StreamOutput(fopen('php://memory', 'w', false));
    }

    public function testItRunsSuccessfully()
    {
        $input = new ArrayInput(array(
            'app:profile:create',
            'name' => 'Igor',
        ));

        $exitCode = $this->app->run($input, $this->output);

        $this->assertSame(0, $exitCode, $this->getDisplay());
    }

    private function getDisplay()
    {
        $stream = $this->output->getStream();
        rewind($stream);

        return stream_get_contents($stream);
    }
}
