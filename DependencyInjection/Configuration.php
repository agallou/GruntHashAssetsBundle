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
        $treeBuilder = new TreeBuilder('grunt_hash_assets');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('assets_dir')
                    ->defaultValue('%kernel.project_dir%/public/assets/')
                ->end()
                ->scalarNode('assets_base_path')
                    ->defaultValue('/assets')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
