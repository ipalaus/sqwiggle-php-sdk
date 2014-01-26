<?php

namespace Ipalaus\Sqwiggle;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Message\Request;

class Client
{

    /**
     * @const  VERSION  Current version of the SDK
     */
    const VERSION = '0.0.1';

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

    /**
     * Retrieves the details of a specific conversation provided the
     * conversation is accessible via the provided token.
     *
     * @param  integer $id Conversation id.
     *
     * @return \Ipalaus\Sqwiggle\Conversation
     */
    public function getConversation($id)
    {
        return new Conversation($this->get('conversations/'.$id));
    }

    /**
     * Returns a list of all conversations within the organization associated
     * with the provided token. This includes both finished and ongoing.
     *
     * @return \Ipalaus\Sqwiggle\Collection
     */
    public function getConversations()
    {
        $conversations = $this->get('conversations');

        $items = new Collection;

        foreach ($conversations as $conversation) {
            $items[] = new Conversation($conversation);
        }

        return $items;
    }

    /**
     * Returns configuration information for Sqwiggle clients, such as where to
     * store file uploads, limits, ice servers and other misc details that are
     * required.
     *
     * @return array
     */
    public function getConfigurationInfo()
    {
        return $this->get('info/configuration');
    }

    /**
     * Returns the current versions of the official Sqwiggle clients across all
     * platforms, this allows apps to auto-update when a new version is
     * available.
     *
     * @return array
     */
    public function getVersionsInfo()
    {
        return $this->get('info/versions');
    }

    /**
     * Returns the configuration and version details in a single request.
     *
     * @return array
     */
    public function getInfo()
    {
        return $this->get('info');
    }

    /**
     * When an invite is created an email is automatically sent to the
     * recipients address asking them to join your organization.
     *
     * @param  string $email Email address that will receive the invite.
     *
     * @return \Ipalaus\Sqwiggle\Invite
     */
    public function createInvite($email)
    {
        return $this->post('invites', array('email' => $email));
    }

    /**
     * Retrieves the details of any invite that has been previously created.
     *
     * @param  integer $id Invite id.
     *
     * @return \Ipalaus\Sqwiggle\Invite
     */
    public function getInvite($id)
    {
        return new Invite($this->get('invites/'.$id));
    }

    /**
     * Removes the specified invite from the organization. This will result in
     * the invite no longer working should the recipient click on the link
     * contained in the invite email.
     *
     * @param  integer $id Invite id.
     *
     * @return boolean
     */
    public function deleteInvite($id)
    {
        return $this->delete('invites/'.$id);
    }

    /**
     * Returns a list of all outstanging invites in the current organization.
     *
     * @return \Ipalaus\Sqwiggle\Collection
     */
    public function getInvites()
    {
        $invites = $this->get('invites');

        $items = new Collection;

        foreach ($invites as $invite) {
            $items[] = new Invite($invite);
        }

        return $items;
    }

    /**
     * Retrieves the details of any organization that the token has access to.
     *
     * @param  integer $id Organization id.
     *
     * @return \Ipalaus\Sqwiggle\Organization
     */
    public function getOrganization($id)
    {
        return new Organization($this->get('organizations/'.$id));
    }

    /**
     * Updates the specified organization name.
     *
     * @param  integer $id   Organization id.
     * @param  string  $name New name.
     *
     * @return \Ipalaus\Sqwiggle\Organization
     */
    public function updateOrganization($id, $name)
    {
        return new Organization($this->put('organizations/'.$id, array('name' => $name)));
    }

    /**
     * Returns a list of all organizations the current token has access to.
     *
     * @return \Ipalaus\Sqwiggle\Collection
     */
    public function getOrganizations()
    {
        $organizations = $this->get('organizations');

        $items = new Collection;

        foreach ($organizations as $organization) {
            $items[] = new Organization($organization);
        }

        return $items;
    }

    /**
     * Create a Room.
     *
     * @param  string $name Create a Room.
     *
     * @return \Ipalaus\Sqwiggle\Room
     */
    public function createRoom($name)
    {
        return new Room($this->post('rooms', array('name' => $name)));
    }

    /**
     * Retrieves the details of any room that the token has access to.
     *
     * @param  integer $id Room id.
     *
     * @return \Ipalaus\Sqwiggle\Room
     */
    public function getRoom($id)
    {
        return new Room($this->get('rooms/'.$id));
    }

    /**
     * Returns a list of all rooms in the current organization. The rooms are
     * returned in sorted alphabetical order by default.
     *
     * @return array List of Room objects.
     */
    public function getRooms()
    {
        $rooms = $this->get('rooms');

        $items = new Collection;

        foreach ($rooms as $room) {
            $items[] = new Room($room);
        }

        return $items;
    }

    /**
     * Updates the specified room by setting the values of the parameters passed.
     *
     * @todo Fix the PUT rooms/:id endpoint.
     *
     * @param  integer $id   ID of the room object to update.
     * @param  string  $name The rooms display name.
     *
     * @return \Ipalaus\Sqwiggle\Room
     */
    public function updateRoom($id, $name)
    {
        return new Room($this->put('rooms/'.$id, array('name' => $name)));
    }

    /**
     * Removes the room from the organisation.
     *
     * @param  integer $id Room id.
     *
     * @return boolean
     */
    public function deleteRoom($id)
    {
        return $this->delete('rooms/'.$id);
    }

    /**
     * Send an authorized request and the response as an array.
     *
     * @param Guzzle\Http\Message\Request $request HTTP request class to send requests.
     *
     * @return array
     */
    protected function send(Request $request)
    {
        try {
            $request = $this->auth->addCredentialsToRequest($request);
            $response = $request->send();
            $statusCode = $response->getStatusCode();
            $body = $response->json();
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
                    throw new Exceptions\BadResponseException($body);
            }
        }

        // if a 204 No Content response is returned we return a confirmation
        // that the requested action has been executed
        if ($statusCode === 204) {
            return true;
        }

        return $body;
    }

    /**
     * Create a GET request for the client.
     *
     * @param  string $uri Resource URI.
     *
     * @return array
     */
    protected function get($uri)
    {
        return $this->send($this->getHttp()->get($uri));
    }

    /**
     * Create a POST request for the client.
     *
     * @param  string $uri      Resource URI.
     * @param  array  $postBody Associative array of POST fields to send in the body of the request.
     * @param  array  $headers  HTTP headers.
     *
     * @return array
     */
    protected function post($uri, $postBody, $headers = null)
    {
        return $this->send($this->getHttp()->post($uri, $headers, $postBody));
    }

    /**
     * Create a PUT request for the client.
     *
     * @param  string $uri     Resource URI.
     * @param  array  $body    Body to send in the request.
     * @param  array  $headers HTTP headers
     *
     * @return array
     */
    protected function put($uri, $body, $headers = null)
    {
        return $this->send($this->getHttp()->put($uri, $headers, $body));
    }

    /**
     * Create a DELETE request for the client.
     *
     * @param  string $uri Resource URI.
     *
     * @return boolean
     */
    protected function delete($uri)
    {
        return $this->send($this->getHttp()->delete($uri));
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
