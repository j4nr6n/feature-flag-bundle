<?php

namespace j4nr6n\FeatureFlagBundle\Twig;

use j4nr6n\FeatureFlagBundle\FeatureCheckerInterface;

final class FeatureFlagRuntime
{
    public function __construct(
        private readonly FeatureCheckerInterface $featureChecker
    ) {
    }

    public function isFeatureEnabled(string $feature, array $context = []): bool
    {
        return $this->featureChecker->isEnabled($feature, $context);
    }
}
