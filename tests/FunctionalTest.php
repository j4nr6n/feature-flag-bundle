<?php

namespace j4nr6n\FeatureFlagBundle\Tests;

use j4nr6n\FeatureFlagBundle\FeatureCheckerInterface;
use j4nr6n\FeatureFlagBundle\VotingFeatureChecker;
use PHPUnit\Framework\TestCase;

class FunctionalTest extends TestCase
{
    public function testServiceWiring(): void
    {
        $kernel = new TestKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $featureChecker = $container->get(FeatureCheckerInterface::class);
        $this->assertInstanceOf(VotingFeatureChecker::class, $featureChecker);
    }
}
