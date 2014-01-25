<?php

use Ipalaus\Sqwiggle\Client;
use Ipalaus\Sqwiggle\BasicAuthentication;

class ClientTest extends PHPUnit_Framework_TestCase
{

    public function testGetHttp()
    {
        $client = new Client(new BasicAuthentication('ipalaus'));

        $method = $this->getMethod('getHttp');
        $return = $method->invokeArgs($client, array());

        $this->assertInstanceOf('Guzzle\Http\Client', $return);
    }

    /**
     * Helper to test protected functions.
     *
     * @param  string  $name
     * @return ReflectionClass
     */
    protected function getMethod($name) {
        $class = new ReflectionClass('Ipalaus\Sqwiggle\Client');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

}
