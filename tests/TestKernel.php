<?php

namespace j4nr6n\FeatureFlagBundle\Tests;

use j4nr6n\FeatureFlagBundle\FeatureFlagBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class TestKernel extends Kernel
{
    public function __construct()
    {
        parent::__construct('test', true);
    }

    public function registerBundles(): iterable
    {
        return [new FeatureFlagBundle()];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
    }
}
