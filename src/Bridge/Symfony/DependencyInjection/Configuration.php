<?php

namespace LogViewerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ScalarNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('log_viewer');
        $rootNode
            ->children()
            ->arrayNode('logs')
            ->useAttributeAsKey('log')
            ->normalizeKeys(false)
            ->prototype('array')
            ->append($this->getPath())
            ->append($this->getMethod())
            ->end()
            ->end()
            ->integerNode('max_tail')->end()
            ->end()
        ;
        return $treeBuilder;
    }
    private function getPath()
    {
        $node = new ScalarNodeDefinition('path');
        $node
            ->defaultValue(null)
            ->end()
        ;
        return $node;
    }
    private function getMethod()
    {
        $node = new ScalarNodeDefinition('method');
        $node
            ->defaultValue(null)
            ->end()
        ;
        return $node;
    }
}