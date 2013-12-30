<?php

namespace Ipalaus\Sqwiggle;

use DateTime;

class Message
{

    /**
     * Message id.
     *
     * @var  integer
     */
    public $id;

    /**
     * Id of the room that this message belongs to.
     *
     * @var  integer
     */
    public $room_id;

    /**
     * The plain text content of the message, HTML will be escaped.
     *
     * @var  string
     */
    public $text;

    /**
     * An object representing the user or API client that created the message.
     *
     * @var  \Ipalaus\Sqwiggle\User
     */
    public $author;

    /**
     * A list of Attachment objects to be displayed with this message.
     *
     * @var  array
     */
    public $attachments;

    /**
     * A list of users tagged / mentioned in this message.
     *
     * @var  array
     */
    public $mentions;

    /**
     * The time that this message was created.
     *
     * @var  \DateTime
     */
    public $created_at;

    /**
     * The time that this message was last updated or edited.
     *
     * @var  \DateTime
     */
    public $updated_at;

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
     * Create a DateTime object from the 'updated_at' string.
     *
     * @param  string  $updated_at  Datetime string.
     * @return void
     */
    public function setCreatedAt($updated_at)
    {
        $this->updated_at = new DateTime($updated_at);
    }

}
