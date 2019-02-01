<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Configuration;

use PHPUnit\Framework\TestCase;
use Shapin\Stripe\Configuration\PlanCreate;
use Shapin\Stripe\Model\Plan\Plan;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

class PlanCreateTest extends TestCase
{
    /**
     * @dataProvider configProvider
     */
    public function testProcess(array $config, ?string $errorMessage = null)
    {
        if (null !== $errorMessage) {
            $this->expectException(InvalidConfigurationException::class);
            $this->expectExceptionMessage($errorMessage);
        } else {
            $this->expectNotToPerformAssertions();
        }

        $processor = new Processor();
        $processor->processConfiguration(new PlanCreate(), [$config]);
    }

    public function configProvider()
    {
        // ## VALID
        // Simple example with product ID
        yield [['currency' => 'EUR', 'interval' => 'week', 'existing_product' => 'a_product']];
        // Simple example with full product
        yield [['currency' => 'EUR', 'interval' => 'week', 'product' => ['id' => 'new_product', 'name' => 'My new product']]];

        // ## INVALID
        // No product
        yield [['currency' => 'EUR', 'interval' => 'week'], 'You must specify either "existing_product" or "product" node.'];
        // Both existing & new product
        yield [['currency' => 'EUR', 'interval' => 'week', 'existing_product' => 'a_product', 'product' => ['id' => 'new_product', 'name' => 'My new product']], 'You cannot specify both "existing_product" and "product" node.'];
        // Missing amount for per_unit billing scheme
        yield [['currency' => 'EUR', 'interval' => 'week', 'existing_product' => 'a_product', 'billing_scheme' => Plan::BILLING_SCHEME_PER_UNIT], '"amount" is required when using  "per_unit" bill scheme.'];
        // Missing tiers for tiered billing scheme
        yield [['currency' => 'EUR', 'interval' => 'week', 'existing_product' => 'a_product', 'billing_scheme' => Plan::BILLING_SCHEME_TIERED], '"tiers" is required when using  "tiered" bill scheme.'];
        // "tiers" used without tiered billing scheme
        yield [['currency' => 'EUR', 'interval' => 'week', 'existing_product' => 'a_product', 'tiers' => ['up_to' => 'inf']], '"tiers" requires using  "tiered" bill scheme.'];
        // Missing tiers_mode for tiered billing scheme
        yield [['currency' => 'EUR', 'interval' => 'week', 'existing_product' => 'a_product', 'billing_scheme' => Plan::BILLING_SCHEME_TIERED, 'tiers' => ['up_to' => 'inf']], '"tiers_mode" is required when using  "tiered" bill scheme.'];
    }
}
