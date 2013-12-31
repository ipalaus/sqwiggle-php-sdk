<?php

namespace Ipalaus\Sqwiggle;

use Guzzle\Http\Message\Request;

class BasicAuthentication implements AuthenticationInterface
{

    /**
     * Client token.
     *
     * @var string
     */
    protected $token;

    /**
     * Create a new HTTP Basic Authentication instance.
     *
     * @param  string  $token  Client token.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

   /**
     * Add the authentication credentials to a request.
     *
     * @param  \Guzzle\Http\Message\Request  $request
     * @return \Guzzle\Http\Message\Request
     */
    public function addCredentialsToRequest(Request $request)
    {
            $request->setAuth($this->token, 'x', 'basic');

            return $request;
    }

}
