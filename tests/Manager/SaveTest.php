<?php

namespace DCS\Role\Provider\ORMBundle\Tests\Manager;

use DCS\Role\Provider\ORMBundle\Manager\Save;

class SaveTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $role;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $entityManager;
    /** @var Save */
    protected $save;

    protected function setUp()
    {
        $this->role = $this->getMock('DCS\Role\Provider\ORMBundle\Model\RoleInterface');
        $this->entityManager = $this->getMock('Doctrine\ORM\EntityManagerInterface');
        $this->save = new Save($this->entityManager);
    }

    public function testSaveAndFlush()
    {
        $this->entityManager->expects($this->exactly(1))->method('persist')->with($this->role);
        $this->entityManager->expects($this->exactly(1))->method('flush');

        call_user_func($this->save, $this->role);
    }

    public function testSaveWithoutFlush()
    {
        $this->entityManager->expects($this->exactly(1))->method('persist')->with($this->role);
        $this->entityManager->expects($this->exactly(0))->method('flush');

        call_user_func_array($this->save, [$this->role, false]);
    }
}