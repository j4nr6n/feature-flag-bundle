<?php

namespace j4nr6n\FeatureFlagBundle;

use j4nr6n\FeatureFlagBundle\Exception\InvalidValueException;

class InMemoryFeatureChecker implements FeatureCheckerInterface
{
    /** @var array<string, bool> */
    private array $features = [];

    /** @param array<string, bool> $features */
    public function setFeatures(array $features): self
    {
        $this->features = $features;

        return $this;
    }

    /** @throws InvalidValueException if the feature is unknown */
    public function isEnabled(string $featureFlag, array $context = []): bool
    {
        if (!\array_key_exists($featureFlag, $this->features)) {
            throw new InvalidValueException(\sprintf('Unknown feature flag: "%s"', $featureFlag));
        }

        return $this->features[$featureFlag];
    }
}
