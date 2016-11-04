<?php

namespace DCS\Role\Provider\ORMBundle\Tests\DependencyInjection;

use DCS\Role\Provider\ORMBundle\DependencyInjection\DCSRoleProviderORMExtension;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DCSRoleProviderORMExtensionTest extends \PHPUnit_Framework_TestCase
{
    private $container;

    protected function setUp()
    {
        $this->container = new ContainerBuilder();

        $config = [
            'dcs_role_provider_orm' => [
                'model_class' => 'ACME/Entity',
            ],
        ];

        $mock = $this->getMockBuilder(DCSRoleProviderORMExtension::class)->setMethods(['processConfiguration'])->getMock();
        $mock->load($config, $this->container);
    }

    public function testLoad()
    {
        $this->assertTrue($this->container->hasParameter('dcs_role.provider.orm.model_class'));
        $this->assertEquals('ACME/Entity', $this->container->getParameter('dcs_role.provider.orm.model_class'));
    }

    public function testLoadXMLConfiguration()
    {
        $resources = $this->container->getResources();
        $this->assertCount(4, $resources);

        /** @var FileResource $resource */
        foreach ($resources as $resource) {
            $this->assertContains(pathinfo($resource->getResource(), PATHINFO_BASENAME), [
                'manager.xml',
                'provider.xml',
                'repository.xml',
                'service.xml',
            ]);
        }
    }
}