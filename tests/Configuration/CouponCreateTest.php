<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Configuration;

use PHPUnit\Framework\TestCase;
use Shapin\Stripe\Configuration\CouponCreate;
use Shapin\Stripe\Model\Coupon\Coupon;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

class CouponCreateTest extends TestCase
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
        $processor->processConfiguration(new CouponCreate(), [$config]);
    }

    public function configProvider()
    {
        // ## VALID
        // Simple example with duration "once"
        yield [['duration' => Coupon::DURATION_ONCE, 'percent_off' => (float) 15]];
        // Simple example with duration "once"
        yield [['duration' => Coupon::DURATION_REPEATING, 'duration_in_months' => 3, 'percent_off' => (float) 15]];
        // Simple example with duration "forever"
        yield [['duration' => Coupon::DURATION_FOREVER, 'percent_off' => (float) 15]];

        // ## INVALID
        // No duration in months when needed
        yield [['duration' => Coupon::DURATION_REPEATING, 'percent_off' => (float) 15], '"duration_in_months" is required when using  "repeating" duration.'];
        // No currency for amount_off
        yield [['duration' => Coupon::DURATION_ONCE, 'amount_off' => 10], '"currency" is required when specifying  "amount_off".'];
        // No amount_off nor percent_off
        yield [['duration' => Coupon::DURATION_ONCE], 'You must specify either an "amount_off" or an "percent_off".'];
    }
}
