<?php

namespace Fixture\Bridge\Symfony\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ScalarNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fixture');
        $rootNode
            ->children()
                ->scalarNode('path')
                    ->defaultValue('default')
                ->end()
                ->scalarNode('loader')
                    ->defaultValue('file')
                ->end()
                ->scalarNode('parser')
                    ->defaultValue('yaml')
                ->end()
                ->scalarNode('driver')
                    ->defaultValue('pdo')
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
