<?php

namespace DCS\Role\Provider\ORMBundle\Tests\Model;

use DCS\Role\Provider\ORMBundle\Model\RoleInterface as DCSRoleInterface;
use Symfony\Component\Security\Core\Role\RoleInterface as SfRoleInterface;
use DCS\Role\Provider\ORMBundle\Tests\RoleTest as Role;

class RoleTest extends \PHPUnit_Framework_TestCase
{
    private static $ROLE_USER = 'ROLE_USER';

    /**
     * @var Role
     */
    private $role;

    protected function setUp()
    {
        $this->role = new Role(self::$ROLE_USER);
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(DCSRoleInterface::class, $this->role);
        $this->assertInstanceOf(SfRoleInterface::class, $this->role);
    }

    public function testSetterAndGetter()
    {
        $this->assertEquals(self::$ROLE_USER, $this->role->getRole());
        $this->role->setId(1);
        $this->assertEquals(1, $this->role->getId());
    }
}