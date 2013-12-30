<?php

namespace Ipalaus\Sqwiggle;

use DateTime;

class Invite
{

    /**
     * Invite id.
     *
     * @var  integer
     */
    public $id;

    /**
     * Id of the user that created the invite.
     *
     * @var  integer
     */
    public $from_id;

    /**
     * The email address that this invite was sent to.
     *
     * @var  string
     */
    public $email;

    /**
     * URL to a static avatar representing the email address.
     *
     * @var  string
     */
    public $avatar;

    /**
     * URL to redeem the invite.
     *
     * @var  string
     */
    public $url;

    /**
     * The time that this invite was created.
     *
     * @var  \DateTime
     */
    public $created_at;

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
