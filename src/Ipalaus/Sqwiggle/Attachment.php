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
     * Create a new Attachment instance.
     *
     * @param array $attachment Attachment details.
     */
    public function __construct(array $attachment = array())
    {
        $this->id = $attachment['id'];
        $this->url = $attachment['url'];
        $this->title = $attachment['title'];
        $this->dscription = isset($attachment['dscription']) ? $attachment['dscription'] : null;
        $this->animated = isset($attachment['animated']) ? $attachment['animated'] : null;
        $this->type = $attachment['type'];
        $this->image = isset($attachment['image']) ? $attachment['image'] : null;
        $this->status = $attachment['status'];
        $this->width = isset($attachment['width']) ? $attachment['width'] : null;
        $this->height = isset($attachment['height']) ? $attachment['height'] : null;
        $this->size = isset($attachment['size']) ? $attachment['size'] : null;

        //$this->setCreatedAt($attachment['created_at']);
        //$this->setUpdatedAt($attachment['updated_at']);
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
