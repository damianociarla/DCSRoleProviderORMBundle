<?php

namespace DCS\Role\Provider\ORMBundle\Manager;

use DCS\Role\Provider\ORMBundle\Model\RoleInterface;
use Doctrine\ORM\EntityManagerInterface;

class Save
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Persists a role instance
     *
     * @param RoleInterface $role
     * @param bool $andFlush
     */
    public function __invoke(RoleInterface $role, $andFlush = true)
    {
        $this->entityManager->persist($role);

        if ($andFlush) {
            $this->entityManager->flush();
        }
    }
}