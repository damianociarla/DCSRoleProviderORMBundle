<?php

namespace DCS\Role\Provider\ORMBundle\Tests;

use DCS\Role\Provider\ORMBundle\ORMProvider;
use DCS\Role\Provider\ORMBundle\Service\RoleFactoryInterface;
use DCS\Role\Provider\ORMBundle\Manager\Save;
use Doctrine\ORM\EntityRepository;

class ORMProviderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $roleFactory;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $save;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $repository;

    public function setUp()
    {
        $this->roleFactory = $this->createMock(RoleFactoryInterface::class);
        $this->save = $this->createMock(Save::class);
        $this->repository = $this->createMock(EntityRepository::class);
    }

    public function testMethodGetRoles()
    {
        $this->repository->expects($this->once())->method('findAll');
        $this->getORMProvider()->getRoles();
    }

    public function testMethodGetRole()
    {
        $role = 'ROLE_ACME';
        $this->repository->expects($this->once())->method('findOneBy')->with(['role' => $role]);
        $this->getORMProvider()->getRole($role);
    }

    public function testMethodHasRoleWithExistingRole()
    {
        $role = 'ROLE_ACME';
        $this->repository->expects($this->once())->method('findOneBy')->willReturn($role);
        $this->assertTrue($this->getORMProvider()->hasRole($role));
    }

    public function testMethodHasRoleWithoutExistingRole()
    {
        $role = 'ROLE_ACME';
        $this->repository->expects($this->once())->method('findOneBy')->willReturn(null);
        $this->assertFalse($this->getORMProvider()->hasRole($role));
    }

    public function testMethodAddRole()
    {
        $role = 'ROLE_ACME';
        $this->roleFactory->expects($this->once())->method('create')->with($role)->willReturn(new RoleTest($role, 1));
        $this->save->expects($this->once())->method('__invoke');
        $this->getORMProvider()->addRole($role);
    }

    private function getORMProvider()
    {
        return new ORMProvider(
            $this->roleFactory,
            $this->save,
            $this->repository
        );
    }
}