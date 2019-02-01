<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Configuration;

use PHPUnit\Framework\TestCase;
use Shapin\Stripe\Configuration\SubscriptionCreate;
use Shapin\Stripe\Model\Subscription\Subscription;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

class SubscriptionCreateTest extends TestCase
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
        $processor->processConfiguration(new SubscriptionCreate(), [$config]);
    }

    public function configProvider()
    {
        // ## VALID
        // Simple example
        yield [['customer' => 'cus_ERVlaeXFbkOLgD', 'items' => [['plan' => 'a_plan']]]];

        // ## INVALID
        // No items
        yield [['customer' => 'cus_ERVlaeXFbkOLgD'], 'The child node "items" at path "shapin_stripe" must be configured.'];
        // invalid usage of days_until_due
        yield [['customer' => 'cus_ERVlaeXFbkOLgD', 'billing' => Subscription::BILLING_CHARGE_AUTOMATICALLY, 'items' => [['plan' => 'a_plan']], 'days_until_due' => 3], 'You can only set "days_until_due" for "send_invoice" billing type.'];
        // invalid usage of trial period days
        yield [['customer' => 'cus_ERVlaeXFbkOLgD', 'items' => [['plan' => 'a_plan']], 'trial_period_days' => 3, 'trial_from_plan' => true], 'You cannot specify "trial_period_days" when "trial_from_plan" is true.'];
    }
}
