j4nr6n/feature-flag-bundle
==========================

## Installation

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Open a command console, enter your project directory and execute:

```console
$ composer require j4nr6n/feature-flag-bundle
```

### Applications that don't use Symfony Flex

Enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    j4nr6n\FeatureFlagBundle\FeatureFlagBundle::class => ['all' => true],
];
```

## Using The Bundle

A voter is an easy way to isolate the code for a given feature, but can also be used to "vote" on more than one feature.

```php
// src/FeatureFlag/MyFeatureVoter.php

// ...
use j4nr6n\FeatureFlagBundle\FeatureVoterInterface;

class MyFeatureVoter implements FeatureVoterInterface
{
    public function supports(string $featureFlag): bool
    {
        return $featureFlag === 'my_new_feature';
    }

    public function isEnabled(string $featureFlag, array $context = []): bool
    {
        // ...
    }
}
```

You can create as many feature voters as you want. Remember though, if any single registered voter returns `true`.
The final result will be `true`.

### In Controllers

```php
// src/Controller/DefaultController.php

// ...
use j4nr6n\FeatureFlagBundle\FeatureCheckerInterface;

class DefaultController extends AbstractController
{
    // ...
    
    #[Route(name: 'app_default_homepage', methods: [Request::METHOD_GET])]
    public function homepage(FeatureCheckerInterface $featureChecker): Response
    {
        return $featureChecker->isEnabled('new_homepage', ['user' => $this->getUser()])
            ? $this->render('default/new_homepage.html.twig')
            : $this->render('default/homepage.html.twig');
    }
}
```

### In Services

```php
// src/Service/SomeService.php

// ...
use j4nr6n/FeatureFlagBundle\FEatureCheckerInterface;

class SomeService
{
    public function __construct(
        private readonly FeatureCheckerInterface $featureChecker
    ) {
    }
    
    public function someMethod() {
        return $this->featureChecker->isEnabled('new_feature')
            ? // Let them experience our greatness!
            : // Not yet...
    }
}
```

### In Twig

```twig
{% include feature_is_enabled('fancy_widget')
    ? '_fancy_widget.html.twig'
    : '_plain_widget.html.twig'
%}
```

## Feature Checkers

If feature voters aren't working out, you can also create your own feature "checker".
See the [`Feature Checker`](docs/feature_checkers.md) documentation for more information.
