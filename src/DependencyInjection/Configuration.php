<?php

/**
* @date 2024-05-07
**/

namespace NeuralGlitch\BootstrapThemeSwitch\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('bs_theme_switch');
        /*
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->children()
                ->scalarNode('some_value_key')
                    ->info('info for some_value')
                    ->defaultValue('default')
                ->end()
            ->end()
        ;
        */
        return $treeBuilder;
    }
}
