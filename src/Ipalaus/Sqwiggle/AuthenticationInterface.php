<?php

namespace Ipalaus\Sqwiggle;

use Guzzle\Http\Message\Request;

interface AuthenticationInterface
{

    /**
     * Add the authentication credentials to a request.
     *
     * @param  \Guzzle\Http\Message\Request  $request
     * @return \Guzzle\Http\Message\Request
     */
    public function addCredentialsToRequest(Request $request);

}
