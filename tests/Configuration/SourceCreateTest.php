<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Configuration;

use PHPUnit\Framework\TestCase;
use Shapin\Stripe\Configuration\SourceCreate;
use Shapin\Stripe\Model\Source\Source;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

class SourceCreateTest extends TestCase
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
        $processor->processConfiguration(new SourceCreate(), [$config]);
    }

    public function configProvider()
    {
        // ## VALID
        // Simple example
        yield [['type' => 'original_source']];
        // Redirect flow with redirect url
        yield [['type' => 'original_source', 'flow' => Source::FLOW_REDIRECT, 'redirect' => ['return_url' => 'http://here.am/I']]];

        // ## INVALID
        // Missing amount for single_use source
        yield [['type' => 'original_source', 'usage' => Source::USAGE_SINGLE_USE], 'Invalid configuration for path "shapin_stripe": "amount" is required for "single_use" sources.'];
        // Receiver is specified but not flow
        yield [['type' => 'original_source', 'receiver' => []], 'Invalid configuration for path "shapin_stripe": "receiver" can be set only for "receiver" flow.'];
        // Receiver is specified but flow is not the correct one
        yield [['type' => 'original_source', 'receiver' => [], 'flow' => Source::FLOW_NONE], 'Invalid configuration for path "shapin_stripe": "receiver" can be set only for "receiver" flow.'];
        // Redirect flow without redirect url
        yield [['type' => 'original_source', 'flow' => Source::FLOW_REDIRECT], 'Invalid configuration for path "shapin_stripe": "redirect" must be set when using "redirect" flow.'];
        // Three D Secure without three_d_secure card
        yield [['type' => 'three_d_secure'], 'Invalid configuration for path "shapin_stripe": "three_d_secure" must be set when using "three_d_secure" source type.'];
        // Three D Secure without redirect infos
        yield [['type' => 'three_d_secure', 'three_d_secure' => ['card' => 'card_12345']], 'Invalid configuration for path "shapin_stripe": "redirect" must be set when using "three_d_secure" source type.'];
    }
}
