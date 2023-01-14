<?php

namespace j4nr6n\FeatureFlagBundle\DependencyInjection;

use j4nr6n\FeatureFlagBundle\FeatureCheckerInterface;
use j4nr6n\FeatureFlagBundle\FeatureVoterInterface;
use j4nr6n\FeatureFlagBundle\InMemoryFeatureChecker;
use j4nr6n\FeatureFlagBundle\Twig\FeatureFlagRuntime;
use j4nr6n\FeatureFlagBundle\VotingFeatureChecker;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class FeatureFlagExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../../config'));
        $loader->load('services.xml');

        /** @var Configuration $configuration */
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $container
            ->registerForAutoconfiguration(FeatureVoterInterface::class)
            ->addTag('j4nr6n_feature_flag.feature_voter');

        $featureChecker = match ($config['feature_checker']) {
            'in_memory' => InMemoryFeatureChecker::class,
            'voting' => VotingFeatureChecker::class,
            default => (string) $config['feature_checker']
        };

        $container
            ->setAlias(FeatureCheckerInterface::class, $featureChecker)
            ->setPublic(true);
    }

    public function getAlias(): string
    {
        return 'j4nr6n_feature_flag';
    }
}
