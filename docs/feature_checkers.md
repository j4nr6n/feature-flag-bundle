Feature Checkers
================
Feature "checkers" are very similar to feature voters.
Where feature voters are concerned with answering the question, feature checkers are more concerned with
shuttling the question around to the service that can answer the question.

The bundle ships with two built-in feature checkers.

## `VotingFeatureChecker`

The [`VotingFeatureChecker`](../src/VotingFeatureChecker.php) implements a simple voting system.
It is the default feature checker in this bundle.

See [Feature Voters](feature_voters.md) for more information.

## `InMemoryFeatureChecker`

The [`InMemoryFeatureChecker`](../src/InMemoryFeatureChecker.php) is intended to be used in tests and doesn't support contextual information.

## Do It Yourself

To create your own feature checker, implement [``j4nr6n/FeatureFlag/FeatureCheckerInterface``](../src/FeatureCheckerInterface.php).

```php
// src/FeatureFlag/CustomFeatureChecker.php

use j4nr6n\FeatureFlagBundle\FeatureCheckerInterface;

class CustomFeatureChecker implements FeatureCheckerInterface
{
    public function isEnabled(string $featureFlag, array $context = []): bool
    {
        // ...
    }
}
```

You'll then need to configure your application to pass this service when
you ask for the feature checker service.

```yaml
# config/packages/j4nr6n_feature_flag.yaml

j4nr6n_feature_flag:
    feature_checker: 'App\FeatureFlag\CustomFeatureChecker'
```
