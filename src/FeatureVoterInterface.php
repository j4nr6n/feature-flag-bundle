<?php

namespace j4nr6n\FeatureFlagBundle;

interface FeatureVoterInterface
{
    /** If supports() returns true, isEnabled() will be called */
    public function supports(string $featureFlag): bool;
    public function isEnabled(string $featureFlag, array $context = []): bool;
}
