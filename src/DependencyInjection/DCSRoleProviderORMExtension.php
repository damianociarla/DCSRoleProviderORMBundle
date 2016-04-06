<?php

namespace DCS\Role\Provider\ORMBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class DCSRoleProviderORMExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->setParameter('dcs_role.provider.orm.model_class', $config['model_class']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('manager.xml');
        $loader->load('provider.xml');
        $loader->load('repository.xml');
        $loader->load('service.xml');
    }
}