<?php

namespace j4nr6n\FeatureFlagBundle;

interface FeatureCheckerInterface
{
    public function isEnabled(string $featureFlag, array $context = []): bool;
}
