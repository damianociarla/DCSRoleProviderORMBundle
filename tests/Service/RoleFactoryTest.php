<?php

namespace DCS\Role\Provider\ORMBundle\Tests\Service;

use DCS\Role\Provider\ORMBundle\Model\RoleInterface as DCSRoleInterface;
use DCS\Role\Provider\ORMBundle\Service\RoleFactory;
use DCS\Role\Provider\ORMBundle\Tests\RoleTest;
use Symfony\Component\Security\Core\Role\RoleInterface as SfRoleInterface;

class RoleFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $factory = new RoleFactory(RoleTest::class);
        $role = $factory->create('ROLE_USER');

        $this->assertInstanceOf(DCSRoleInterface::class, $role);
        $this->assertInstanceOf(SfRoleInterface::class, $role);
        $this->assertEquals('ROLE_USER', $role->getRole());
    }
}