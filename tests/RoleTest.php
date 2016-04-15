<?php

namespace DCS\Role\Provider\ORMBundle\Tests;

use DCS\Role\Provider\ORMBundle\Model\Role;

class RoleTest extends Role
{
    public function __construct($role, $id = null)
    {
        parent::__construct($role);

        if (null !== $id) {
            $this->setId($id);
        }
    }
}