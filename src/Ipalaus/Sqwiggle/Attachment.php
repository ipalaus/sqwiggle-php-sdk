<?php

namespace Ipalaus\Sqwiggle;

use DateTime;

class Attachment
{

    /**
     * Attachment id.
     *
     * @var  integer
     */
    public $id;

    /**
     * Type of the attachment: image, link, file, twitter_status, twitter_user,
     * video, code, gist.
     *
     * @var  string
     */
    public $type;

    /**
     * URL where the attachment content can be accessed.
     *
     * @var  string
     */
    public $url;

    /**
     * A title for the attachment, for example a filename or webpage title.
     *
     * @var  string
     */
    public $title;

    /**
     * A description of the attachment, for example a web page summary.
     *
     * @var string
     */
    public $description;

    /**
     * URL of an image representing the attachment, this may not reside on
     * Sqwiggle's servers.
     *
     * @var  string
     */
    public $image;

    /**
     * The location at whih the attachment resides.
     *
     * @var  string
     */
    //public $url;

    /**
     * If an upload, denotes the uploade status: pending or uploaded.
     *
     * @var  string
     */
    public $status = null;

    /**
     * If an image, denotes whether animated.
     *
     * @var  boolean
     */
    public $animated = null;

    /**
     * The time that this attachment was created.
     *
     * @var  \DateTime
     */
    public $created_at;

    /**
     * The time that this attachment was last updated or edited.
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
