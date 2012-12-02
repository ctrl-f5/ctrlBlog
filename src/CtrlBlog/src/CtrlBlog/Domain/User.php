<?php

namespace Ctrl\Blog\Domain;

use \Ctrl\Blog\Domain;
use Ctrl\Module\Auth\Domain\User as AuthUser;

class User extends \Ctrl\Domain\PersistableModel
{
    /**
     * @var AuthUser
     */
    protected $authUser;

    protected $displayName;

    /**
     * @var \DateTime
     */
    protected $dateCreated;

    public function __construct(AuthUser $authUser)
    {
        $this->authUser = $authUser;
        $this->dateCreated = new \DateTime('now', new \DateTimeZone('UTC'));
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @return AuthUser
     */
    public function getAuthUser()
    {
        return $this->authUser;
    }
}
