<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Configuration;

use PHPUnit\Framework\TestCase;
use Shapin\Stripe\Configuration\RefundCreate;
use Shapin\Stripe\Model\Refund\Refund;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

class RefundCreateTest extends TestCase
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
        $processor->processConfiguration(new RefundCreate(), [$config]);
    }

    public function configProvider()
    {
        // ## VALID
        // Simple example
        yield [['charge' => 'ch_123456789']];
        // Full
        yield [['charge' => 'ch_123456789', 'amount' => 1000, 'metadata' => ['key' => 'value'], 'reason' => 'duplicate', 'refund_application_fee' => true, 'reverse_transfer' => true]];
    }
}
