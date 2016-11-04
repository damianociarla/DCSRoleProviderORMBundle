<?php

namespace DCS\Role\Provider\ORMBundle\Tests;

use DCS\Role\Provider\ORMBundle\DCSRoleProviderORMBundle;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DCSRoleProviderORMBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildAddsProviderCompilerPass()
    {
        $containerBuilder = $this->createMock(ContainerBuilder::class);
        $containerBuilder->expects($this->atLeastOnce())
            ->method('addCompilerPass')
            ->with($this->isInstanceOf(DoctrineOrmMappingsPass::class));

        $bundle = new DCSRoleProviderORMBundle();
        $bundle->build($containerBuilder);
    }
}