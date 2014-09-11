<?php

namespace Agallou\GruntHashAssetsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('grunt_hash_assets');

        $rootNode
            ->children()
                ->scalarNode('assets_dir')
                    ->defaultValue('%kernel.root_dir%/../web/assets/')
                ->end()
                ->scalarNode('assets_base_path')
                    ->defaultValue('/assets')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
