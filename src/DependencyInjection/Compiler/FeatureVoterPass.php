<?php

namespace j4nr6n\FeatureFlagBundle\DependencyInjection\Compiler;

use j4nr6n\FeatureFlagBundle\VotingFeatureChecker;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class FeatureVoterPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(VotingFeatureChecker::class)) {
            return;
        }

        $definition = $container->findDefinition(VotingFeatureChecker::class);
        $taggedServices = $container->findTaggedServiceIds('j4nr6n_feature_flag.feature_voter');

        foreach ($taggedServices as $id => $_) {
            $definition->addMethodCall('addVoter', [new Reference($id)]);
        }
    }
}
