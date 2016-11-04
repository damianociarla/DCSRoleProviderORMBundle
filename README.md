[![Build Status](https://travis-ci.org/damianociarla/DCSRoleProviderORMBundle.svg?branch=master)](https://travis-ci.org/damianociarla/DCSRoleProviderORMBundle) 
[![Coverage Status](https://coveralls.io/repos/github/damianociarla/DCSRoleProviderORMBundle/badge.svg?branch=master)](https://coveralls.io/github/damianociarla/DCSRoleProviderORMBundle?branch=master)

# DCSRoleProviderORMBundle

This bundle provides the provider implementation for [DCSRoleCoreBundle](https://github.com/damianociarla/DCSRoleCoreBundle). 
This provider is built in on **Doctrine ORM** and performs a mapping of the [Role](https://github.com/damianociarla/DCSRoleProviderORMBundle/blob/master/src/Model/Role.php) class. 

To manage the roles through your User class this bundle provides the [UserRoleCollection](https://github.com/damianociarla/DCSRoleProviderORMBundle/blob/master/src/Model/UserRoleCollection.php) trait.

## Installation

### Prerequisites

This bundle requires [DCSRoleCoreBundle](https://github.com/damianociarla/DCSRoleCoreBundle).

### Require the bundle

Run the following command:

	$ composer require dcs/role-provider-orm-bundle "~1.0@dev"

Composer will install the bundle to your project's `vendor/dcs/role-provider-orm-bundle` directory.

### Enable the bundle

Enable the bundle in the kernel:

	<?php
	// app/AppKernel.php

	public function registerBundles()
	{
		$bundles = array(
			// ...
			new DCS\Role\Provider\ORMBundle\DCSRoleProviderORMBundle(),
			// ...
		);
	}

### Create your Role class

You must provide a concrete Role class. You must extend the abstract model `DCS\Role\Provider\ORMBundle\Model\Role` and create the appropriate mapping.

##### Annotations

    <?php
    // src/AcmeBundle/Entity/Role.php

    namespace AcmeBundle\Entity;

    use DCS\Role\Provider\ORMBundle\Model\Role as RoleBase;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity
     * @ORM\Table(name="role")
     */
    class Role extends RoleBase
    {
        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;
    }

##### Yaml

    # src/AcmeBundle/Resources/config/doctrine/Role.orm.yml
	AcmeBundle\Entity\Role:
	    type:  entity
	    table: role
	    id:
	        id:
	            type: integer
	            generator:
	                strategy: AUTO

##### Xml

	<?xml version="1.0" encoding="utf-8"?>
	<!-- src/AcmeBundle/Resources/config/doctrine/Role.orm.xml -->
	<doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
	                  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	                  xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">
	
	    <entity name="AcmeBundle\Entity\Role" table="role">
	        <id name="id" type="integer" column="id">
	            <generator strategy="AUTO"/>
	        </id>
	    </entity>
	</doctrine-mapping>
	
### Update your User class

In this step you'll need to update your **User** class to make it compatible with the **Role** class created in the previous step. For convenience, we will use the [UserRoleCollection](https://github.com/damianociarla/DCSRoleProviderORMBundle/blob/master/src/Model/UserRoleCollection.php) trait.

##### Annotations

    <?php
    // src/AcmeBundle/Entity/User.php

    namespace AcmeBundle\Entity;

    use DCS\User\CoreBundle\Model\User as UserBase;
    use DCS\Role\Provider\ORMBundle\Model\UserRoleCollection;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * ... your mapping entity
     */
    class User extends UserBase
    {
        use UserRoleCollection;
        
        //... other mapping fields
        
        /**
         * @ORM\ManyToMany(targetEntity="AcmeBundle\Entity\Role")
         * @ORM\JoinTable(name="user_role",
         *   joinColumns={
         *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
         *   },
         *   inverseJoinColumns={
         *     @ORM\JoinColumn(name="role_id", referencedColumnName="id")
         *   }
         * )
         */
        protected $roles;
    }


##### Yaml

    # src/AcmeBundle/Resources/config/doctrine/User.orm.yml
	AcmeBundle\Entity\User:
	    //... your mapping entity
	    manyToMany:
            roles:
                targetEntity: AcmeBundle\Entity\Role
                joinTable:
                    name: user_role
                    joinColumns:
                        user_id:
                            referencedColumnName: id
                    inverseJoinColumns:
                        role_id:
                            referencedColumnName: id

##### Xml

	<?xml version="1.0" encoding="utf-8"?>
	<!-- src/AcmeBundle/Resources/config/doctrine/User.orm.xml -->
	<doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
	                  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	                  xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">
	
	    <entity name="AcmeBundle\Entity\User">
	        <!-- your mapping entity -->
	        <many-to-many field="roles" target-entity="AcmeBundle\Entity\Role">
                <join-table name="user_role">
                    <join-columns>
                        <join-column name="user_id" referenced-column-name="id" />
                    </join-columns>
                    <inverse-join-columns>
                        <join-column name="role_id" referenced-column-name="id" />
                    </inverse-join-columns>
                </join-table>
            </many-to-many>
	    </entity>
	</doctrine-mapping>

### Configure

Now that you have properly enabled this bundle, the next step is to configure it to work with the specific needs of your application.

Add the following configuration to your `config.yml`.

    dcs_role_provider_orm:
        model_class: AcmeBundle\Entity\Role

The following lines provide the configuration for the **DCSRoleCoreBundle**.        
        
    dcs_role_core:
        provider: dcs_role.provider.orm

# Reporting an issue or a feature request

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/damianociarla/DCSRoleProviderORMBundle/issues).