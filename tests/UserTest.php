<?php

namespace DCS\Role\Provider\ORMBundle\Tests;

use DCS\Role\Provider\ORMBundle\Model\UserRoleCollection;
use DCS\User\CoreBundle\Model\User;

class UserTest extends User
{
    use UserRoleCollection;
}