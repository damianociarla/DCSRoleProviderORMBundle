<?php

namespace DCS\Role\Provider\ORMBundle\Service;

use DCS\Role\Provider\ORMBundle\Model\RoleInterface;

interface RoleFactoryInterface
{
    /**
     * Create a new empty Role object
     *
     * @param string $role
     * @return RoleInterface
     */
    public function create($role);
}