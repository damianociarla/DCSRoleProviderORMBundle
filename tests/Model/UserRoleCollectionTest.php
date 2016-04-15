<?php

namespace DCS\Role\Provider\ORMBundle\Tests\Model;

use DCS\Role\Provider\ORMBundle\Tests\RoleTest as Role;
use DCS\Role\Provider\ORMBundle\Tests\UserTest;

class UserRoleCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getRoleProvider
     */
    public function testCollectionMethod($roles, $expected, $roleToFound, $expectedResultFound, $roleToRemove, $expectedAfterRemove)
    {
        $user = new UserTest();

        foreach ($roles as $role) {
            $user->addRole($role);
        }

        $this->assertCount($expected, $user->getRoles());
        $this->assertEquals($expectedResultFound, $user->hasRole($roleToFound));
        $user->removeRole($roleToRemove);
        $this->assertCount($expectedAfterRemove, $user->getRoles());
    }
    
    public function getRoleProvider()
    {
        $roleDefault = new Role('ROLE_DEFAULT', 1);
        $roleUser    = new Role('ROLE_USER', 2);
        $roleAdmin   = new Role('ROLE_ADMIN', 3);

        return [
            [[$roleDefault, $roleUser], 2, $roleDefault, true, $roleUser, 1],
            [[$roleDefault, $roleUser], 2, $roleAdmin, false, $roleUser, 1],
            [[$roleDefault, $roleUser], 2, $roleDefault, true, $roleAdmin, 2],
            [[$roleDefault, $roleUser], 2, $roleAdmin, false, $roleAdmin, 2],
        ];
    }
}