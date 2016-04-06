<?php

namespace DCS\Role\Provider\ORMBundle;

use DCS\Role\CoreBundle\Provider\ProviderInterface;
use DCS\Role\Provider\ORMBundle\Manager\GetRepository;
use DCS\Role\Provider\ORMBundle\Manager\Save;
use DCS\Role\Provider\ORMBundle\Service\RoleFactoryInterface;
use Doctrine\ORM\EntityRepository;

class ORMProvider implements ProviderInterface
{
    /**
     * @var RoleFactoryInterface
     */
    private $roleFactory;

    /**
     * @var Save
     */
    private $save;

    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * ORMProvider constructor.
     *
     * @param RoleFactoryInterface $roleFactory
     * @param Save $save
     * @param EntityRepository $repository
     */
    public function __construct(RoleFactoryInterface $roleFactory, Save $save, EntityRepository $repository)
    {
        $this->roleFactory = $roleFactory;
        $this->save = $save;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return $this->repository->findAll();
    }

    /**
     * @inheritDoc
     */
    public function getRole($role)
    {
        return $this->repository->findOneBy([
            'role' => $role
        ]);
    }

    /**
     * @inheritDoc
     */
    public function hasRole($role)
    {
        return null !== $this->getRole($role);
    }

    /**
     * @inheritDoc
     */
    public function addRole($role)
    {
        call_user_func(
            $this->save,
            $this->roleFactory->create($role)
        );
    }
}