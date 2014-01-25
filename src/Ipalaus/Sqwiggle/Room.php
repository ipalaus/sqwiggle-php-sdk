<?php

namespace Ipalaus\Sqwiggle;

use DateTime;

class Room
{

    /**
     * Room id.
     *
     * @var  integer
     */
    public $id;

    /**
     * Id of the user that created this room.
     *
     * @var  integer
     */
    public $user_id;

    /**
     * The full room name.
     *
     * @var  string
     */
    public $name;

    /**
     * The path to access room in the web app, eg sqwiggle.com/:company/:path.
     *
     * @var  string
     */
    public $path;

    /**
     * The number of users currently in the room.
     *
     * @var  integer
     */
    public $user_count;

    /**
     * The time that this room was created.
     *
     * @var  \DateTime
     */
    public $created_at;

    /**
     * Create a new Room instance.
     *
     * @param array $room Room details.
     */
    public function __construct(array $room = array())
    {
        $this->id = $room['id'];
        $this->user_id = $room['user_id'];
        $this->name = $room['name'];
        $this->path = $room['path'];

        $this->setCreatedAt($room['created_at']);
    }

    /**
     * Create a DateTime object from the 'created_at' string.
     *
     * @param  string  $created_at  Datetime string.
     * @return void
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = new DateTime($created_at);
    }

}
