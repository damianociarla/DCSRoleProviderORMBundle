<?php

namespace DCS\Role\Provider\ORMBundle\Service;

class RoleFactory implements RoleFactoryInterface
{
    /**
     * @var string
     */
    private $modelClass;

    public function __construct($modelClass)
    {
        $this->modelClass = $modelClass;
    }

    /**
     * @inheritdoc
     */
    public function create($role)
    {
        $className = $this->modelClass;
        return new $className($role);
    }
}