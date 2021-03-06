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
     * Create a new Message instance.
     *
     * @param array $message Message details.
     */
    public function __construct(array $message = array())
    {
        $this->id = $message['id'];
        $this->type = $message['type'];
        $this->room_id = $message['room_id'];
        $this->text = $message['text'];
        $this->author = $message['author'];
        $this->mentions = $message['mentions'];

        if (isset($message['attachments'])) {
            $this->setAttachments($message['attachments']);
        }

        $this->setCreatedAt($message['created_at']);
        $this->setUpdatedAt($message['updated_at']);
    }

    /**
     * Create a Collection of attachments.
     *
     * @param array $attachments Attachments included in the message.
     */
    public function setAttachments($attachments)
    {
        $items = new Collection;

        foreach ($attachments as $attachment) {
            $items[] = new Attachment($attachment);
        }

        $this->attachments = $items;
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
     * Create a DateTime object from the 'updated_at' string.
     *
     * @param  string  $updated_at  Datetime string.
     * @return void
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = new DateTime($updated_at);
    }

}
