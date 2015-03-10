<?php
// File: src/AppBundle/RequestHandler/RequestHandler.php

namespace AppBundle\RequestHandler;

interface RequestHandler
{
    // @return Response
    public function handle(Request $request);
}
