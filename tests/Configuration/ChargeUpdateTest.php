<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Configuration;

use PHPUnit\Framework\TestCase;
use Shapin\Stripe\Configuration\ChargeUpdate;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

class ChargeUpdateTest extends TestCase
{
    /**
     * @dataProvider configProvider
     */
    public function testProcess(array $config, bool $isValid)
    {
        if (!$isValid) {
            $this->expectException(InvalidConfigurationException::class);
        } else {
            $this->expectNotToPerformAssertions();
        }

        $processor = new Processor();
        $processor->processConfiguration(new ChargeUpdate(), [$config]);
    }

    public function configProvider()
    {
        // Simple example
        yield [['customer' => 'coucou'], true];
        // Empty fraud details
        yield [['fraud_details' => []], false];
        // Incomplete shipping hash
        yield [['shipping' => ['name' => 'Incomplete']], false];
        // Full example
        yield [[
            'customer' => 'my_awesome_customer',
            'description' => 'This is a full test',
            'fraud_details' => [
                'user_report' => 'safe',
            ],
            'metadata' => [
                'key1' => null, // In order to remove key from existing metadata
                'key2' => 'amazing',
                'key3' => 'test',
            ],
            'receipt_email' => 'awesome@test.fr',
            'shipping' => [
                'address' => [
                    'line1' => 'Mandatory line',
                    'city' => 'Not required',
                ],
                'name' => 'Shipping',
                'carrier' => 'UPS',
            ],
            'trasnfer_group' => 'new_one',
        ], true];
    }
}
