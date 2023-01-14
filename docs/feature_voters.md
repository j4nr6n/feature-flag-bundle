Feature Voters
==============

The [`VotingFeatureChecker`](../src/VotingFeatureChecker.php) implements a simple voting system.

Because of some fancy bundle configuration, when the application starts, Symfony automatically registers any services
that implement [`j4nr6n/FeatureFlag/FeatureVoterInterface`](../src/FeatureVoterInterface.php)
with the voting feature checker.

If any single voter returns `true`, the final result will be `true`.

```php
// src/FeatureFlag/RandomFeatureVoter.php

use j4nr6n\FeatureFlagBundle\FeatureVoterInterface;

class RandomFeatureVoter implements FeatureVoterInterface
{
    public function supports(string $featureFlag): bool
    {
        return $featureFlag === 'random';
    }

    public function isEnabled(string $featureFlag, array $context = []): bool
    {
        return (bool) random_int(0, 1);
    }
}
```
