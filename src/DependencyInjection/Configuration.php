<?php

namespace j4nr6n\FeatureFlagBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('j4nr6n_feature_flag');

        /**
         * @psalm-suppress UndefinedMethod
         * @psalm-suppress MixedMethodCall
         */
        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('feature_checker')
                    ->defaultValue('voting')
                    ->example(['in_memory', 'voting'])
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
