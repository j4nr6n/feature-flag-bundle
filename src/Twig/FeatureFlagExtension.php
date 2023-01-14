<?php

namespace j4nr6n\FeatureFlagBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class FeatureFlagExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('feature_is_enabled', [FeatureFlagRuntime::class, 'isFeatureEnabled']),
        ];
    }
}
