<?php

namespace Onceit\RaygunBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('onceit_raygun');
        $rootNode
            ->children()
                ->scalarNode('api_key')->defaultNull()->end()
                ->booleanNode('async_sending')->defaultValue(true)->end()
                ->booleanNode('debug')->defaultValue(false)->end()
                ->arrayNode('tags')
                    ->prototype('scalar')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
