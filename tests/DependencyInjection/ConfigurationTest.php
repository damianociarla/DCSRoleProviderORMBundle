<?php

namespace DCS\Role\Provider\ORMBundle\Tests\DependencyInjection;

use DCS\Role\Provider\ORMBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ScalarNode;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Configuration
     */
    private $configuration;

    protected function setUp()
    {
        $this->configuration = new Configuration();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(ConfigurationInterface::class, $this->configuration);
    }

    public function testGetConfigTreeBuilder()
    {
        $this->assertInstanceOf(TreeBuilder::class, $this->configuration->getConfigTreeBuilder());
    }

    public function testRootNodeNameBuilder()
    {
        $treeBuilder = $this->configuration->getConfigTreeBuilder();
        $this->assertEquals('dcs_role_provider_orm', $treeBuilder->buildTree()->getName());
    }

    public function testModelClassNode()
    {
        $treeBuilder = $this->configuration->getConfigTreeBuilder();

        /** @var \Symfony\Component\Config\Definition\ArrayNode $tree */
        $tree = $treeBuilder->buildTree();

        $this->assertArrayHasKey('model_class', $children = $tree->getChildren());
        $this->assertInstanceOf(ScalarNode::class, $children['model_class']);
    }
}