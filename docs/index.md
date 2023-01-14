## Bundle Configuration

```
# config/packages/j4nr6n_feature_flag.yaml

j4nr6n_feature_flag:
    feature_checker: voting # default
```
## Feature Checkers

The default feature checker in the bundle is the [`VotingFeatureChecker`](../src/VotingFeatureChecker.php).
See [Feature Voters](feature_voters.md) for more information about creating feature voters.

To create your own feature checker, see [Feature Checkers](feature_checkers.md).
