<?php

namespace j4nr6n\FeatureFlagBundle;

use j4nr6n\FeatureFlagBundle\DependencyInjection\Compiler\FeatureVoterPass;
use j4nr6n\FeatureFlagBundle\DependencyInjection\FeatureFlagExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class FeatureFlagBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new FeatureVoterPass());
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        if ($this->extension === null) {
            $this->extension = new FeatureFlagExtension();
        }

        /** @var ExtensionInterface */
        return $this->extension;
    }
}
