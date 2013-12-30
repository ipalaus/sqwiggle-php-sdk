<?php

namespace Ipalaus\Sqwiggle;

class Conversation
{

    /**
     * Conversation id.
     *
     * @var  integer
     */
    public $id;

    /**
     * The room that this conversation took place in.
     *
     * @var  integer
     */
    public $room_id;

    /**
     * Status of the conversation (open, closed).
     *
     * @var string
     */
    public $status;

    /**
     * A list of User objects that are currently participating in the
     * conversation.
     *
     * @var array
     */
    public $participating;

    /**
     * A list of User objects that have been and or are currently in the
     * conversation.
     *
     * @var array
     */
    public $participated;

}
