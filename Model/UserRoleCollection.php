<?php

namespace DCS\Role\Provider\ORMBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ArrayRoleEditable
 *
 * @property ArrayCollection $roles
 */
trait UserRoleCollection
{
    /**
     * Override User::getRoles to return array
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }

    /**
     * Add role if not exists
     *
     * @param RoleInterface $role
     * @return void
     */
    public function addRole(RoleInterface $role)
    {
        if (!$this->hasRole($role)) {
            $this->roles[] = $role;
        }
    }

    /**
     * Remove role if exists
     *
     * @param RoleInterface $role
     * @return void
     */
    public function removeRole(RoleInterface $role)
    {
        if ($this->hasRole($role)) {
            $this->roles->removeElement($role);
        }
    }

    /**
     * Check if role exists
     *
     * @param RoleInterface $role
     * @return bool
     */
    public function hasRole(RoleInterface $role)
    {
        return $this->roles->contains($role);
    }

    /**
     * Init all user roles
     *
     * @return void
     */
    protected function initRoles()
    {
        $this->roles = new ArrayCollection();
    }
}