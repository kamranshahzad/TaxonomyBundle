<?php


namespace Kamran\TaxonomyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;


class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kamran_taxonomy');
        $rootNode
            ->children()
            ->scalarNode('upload_dir')
            ->defaultValue('/tmp/uploads') // or whatever default value
            ->end()
            ->end()
        ;
        return $treeBuilder;
    }

}
