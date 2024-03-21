<?php

namespace j4nr6n\FeatureFlagBundle;

use j4nr6n\FeatureFlagBundle\Exception\InvalidValueException;

class VotingFeatureChecker implements FeatureCheckerInterface
{
    /** @var array<array-key, FeatureVoterInterface> */
    private array $featureVoters = [];

    public function addVoter(FeatureVoterInterface $featureVoter): self
    {
        $this->featureVoters[] = $featureVoter;

        return $this;
    }

    /** @throws InvalidValueException if the feature is unknown */
    public function isEnabled(string $featureFlag, array $context = []): bool
    {
        $isEnabled = null;

        foreach ($this->featureVoters as $voter) {
            if ($voter->supports($featureFlag)) {
                // If any one voter returns true, the method returns true.
                $isEnabled = $isEnabled || $voter->isEnabled($featureFlag, $context);
            }
        }

        if ($isEnabled === null) {
            throw new InvalidValueException(\sprintf('Unknown feature flag: "%s"', $featureFlag));
        }

        return $isEnabled;
    }
}
