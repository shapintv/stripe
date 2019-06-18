<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Configuration;

use PHPUnit\Framework\TestCase;
use Shapin\Stripe\Configuration\TaxRateCreate;
use Shapin\Stripe\Model\TaxRate\TaxRate;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

class TaxRateCreateTest extends TestCase
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
        $processor->processConfiguration(new TaxRateCreate(), [$config]);
    }

    public function configProvider()
    {
        // ## VALID
        // Simple example
        yield [['display_name' => 'A tax rate', 'inclusive' => true, 'percentage' => 19.3]];
        // Full example
        yield [['display_name' => 'A tax rate', 'inclusive' => true, 'percentage' => 19.3, 'active' => true, 'description' => 'A description', 'jurisdiction' => 'FR', 'metadata' => ['key' => 'value']]];
    }
}
