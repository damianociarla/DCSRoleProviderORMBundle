<?php

namespace DCS\Role\Provider\ORMBundle\Model;

use Symfony\Component\Security\Core\Role\RoleInterface as CoreRoleInterface;

interface RoleInterface extends CoreRoleInterface
{
    /**
     * Get id
     *
     * @return mixed
     */
    public function getId();

    /**
     * Sets id
     *
     * @param mixed $id
     * @return RoleInterface
     */
    public function setId($id);
}