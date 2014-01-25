<?php

namespace Ipalaus\Sqwiggle;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Message\Request;

class Client
{

    /**
     * @const  VERSION  Current version of the SDK
     */
    const VERSION = '1.0.0';

    /**
     * Endpoint base URL.
     *
     * @var  string
     */
    protected $url = 'https://api.sqwiggle.com/';

    /**
     * Authentification implementation.
     *
     * @var  \Ipalaus\Sqwiggle\AuthenticationInterface
     */
    protected $auth;

    /**
     * Create a new Client instance.
     *
     * @param  \Ipalaus\Sqwiggle\AuthenticationInterface  $auth  Auth implmentation.
     */
    public function __construct(AuthenticationInterface $auth)
    {
        $this->auth = $auth;
    }

    public function createRoom($name)
    {
        return $this->send($this->getHttp()->post('rooms', null, array('name' => $name)));
    }

    /**
     * Returns a list of all rooms in the current organization. The rooms are
     * returned in sorted alphabetical order by default.
     *
     * @return  array  List of Room objects.
     */
    public function getRooms()
    {
        $rooms = $this->send($this->getHttp()->get('rooms'));

        $items = array();

        foreach ($rooms as $room) {
            $item = new Room;

            $item->id = $room['id'];
            $item->user_id = $room['user_id'];
            $item->name = $room['name'];
            $item->setCreatedAt($room['created_at']);
            $item->path = $room['path'];
            $item->user_count = $room['user_count'];

            $items[] = $item;
        }

        return $items;
    }

    /**
     * Send an authorized request and the response as an array.
     *
     * @param  \Guzzle\Http\Message\Request  $request
     * @return array
     */
    protected function send(Request $request)
    {
        try {
            $request = $this->auth->addCredentialsToRequest($request);
            $response = $request->send()->json();
        } catch (ClientErrorResponseException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $body = $response->json();

            switch ($statusCode) {
                case 401:
                    throw new Exceptions\AuthenticationException($body['message']);
                case 402:
                    throw new Exceptions\PaymentRequiredException($body['message']);
                case 403:
                    throw new Exceptions\AuthorizationException($body['message']);
                case 404:
                    throw new Exceptions\NotFoundException($body['message']);
                case 500:
                    throw new Exceptions\ServerErrorException($body['message']);
                default:
                    $exception = new Exceptions\BadResponseException($body);
                    throw $exception;
            }
        }

        return $response;
    }

    /**
     * Create a new HTTP client.
     *
     * @return  \Guzzle\Http\Client  Guzzle HTTP Client.
     */
    protected function getHttp()
    {
        return new \Guzzle\Http\Client($this->url);
    }

}
