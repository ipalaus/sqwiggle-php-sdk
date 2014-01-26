<?php

namespace Ipalaus\Sqwiggle;

use DateTime;

class Organization
{

    /**
     * Organization id.
     *
     * @var  integer
     */
    public $id;

    /**
     * The full organisation name.
     *
     * @var  string
     */
    public $name;

    /**
     * The time that this company was created.
     *
     * @var  \Datetime
     */
    public $created_at;

    /**
     * The url path to access company on app, eg sqwiggle.com/:path.
     *
     * @var  string
     */
    public $path;

    /**
     * Billing information.
     *
     * @var  array
     */
    public $billing;

    /**
     * Security parameters.
     *
     * @var  array
     */
    public $security;

    /**
     * Create a new Organization instance.
     *
     * @param array $organization Organization details.
     */
    public function __construct(array $organization = array())
    {
        $this->id = $organization['id'];
        $this->name = $organization['name'];
        $this->path = $organization['path'];
        $this->billindg = $organization['billing'];
        $this->security = $organization['security'];

        $this->setCreatedAt($organization['created_at']);
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
