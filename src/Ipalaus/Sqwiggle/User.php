<?php

namespace Ipalaus\Sqwiggle;

use DateTime;

class User
{

    /**
     * User id.
     *
     * @var  integer
     */
    public $id;

    /**
     * Role of the user: user, owner or manager.
     *
     * @var  string
     */
    public $role;

    /**
     * Media type: video, audio or screen
     *
     * @var  string
     */
    public $media;

    /**
     * Status: busy or available.
     *
     * @var  string
     */
    public $status;

    /**
     * A status message that other users see, such as "out for lunch"
     *
     * @var  string
     */
    public $message;

    /**
     * The users full name.
     *
     * @var  string
     */
    public $name;

    /**
     * The users email address.
     *
     * @var  string
     */
    public $email;

    /**
     * The users email confirmation status.
     *
     * @var  boolean
     */
    public $confirmed;

    /**
     * Timezone (rails format).
     *
     * @var  string
     */
    public $time_zone;

    /**
     * Hours offset from UTC, note that this may be a non-integer like 5.5.
     *
     * @var  float
     */
    public $time_zone_offset;

    /**
     * The time this use was created.
     *
     * @var  \DateTime
     */
    public $created_at;

    /**
     * The last time we recorded activity for a user.
     *
     * @var  \DateTime
     */
    public $last_active_at;

    /**
     * The time this users current online session started.
     *
     * @var  \DateTime
     */
    public $last_connected_at;

    /**
     * URL to users last known still image.
     *
     * @var  string
     */
    public $last_still;

    /**
     * URL to a static avatar for the user.
     *
     * @var  avatar
     */
    public $avatar;

    /**
     * Create a new User instance.
     *
     * @param array $user User details.
     */
    public function __construct(array $user = array())
    {
        $this->id = $user['id'];
        $this->room_id = $user['room_id'];
        $this->media = $user['media'];
        $this->role = $user['role'];
        $this->status = $user['status'];
        $this->message = $user['message'];
        $this->email = $user['email'];
        $this->name = $user['name'];
        $this->avatar = $user['avatar'];
        $this->time_zone = $user['time_zone'];
        $this->time_zone_offset = $user['time_zone_offset'];
        //$this->confirmed = $user['confirmed'];

        $this->setCreatedAt($user['created_at']);
        $this->setLastActiveAt($user['last_active_at']);
        $this->setLastConnectedAt($user['last_connected_at']);
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

    /**
     * Create a DateTime object from the 'last_active_at' string.
     *
     * @param  string  $last_active_at  Datetime string.
     * @return void
     */
    public function setLastActiveAt($last_active_at)
    {
        $this->last_active_at = new DateTime($last_active_at);
    }

    /**
     * Create a DateTime object from the 'last_connected_at' string.
     *
     * @param  string  $last_connected_at  Datetime string.
     * @return void
     */
    public function setLastConnectedAt($last_connected_at)
    {
        $this->last_connected_at = new DateTime($last_connected_at);
    }

}
