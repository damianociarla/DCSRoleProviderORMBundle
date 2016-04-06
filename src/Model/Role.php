<?php

namespace DCS\Role\Provider\ORMBundle\Model;

abstract class Role implements RoleInterface
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRole()
    {
        return $this->role;
    }
}