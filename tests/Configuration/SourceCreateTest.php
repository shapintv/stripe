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
    public function testProcess(array $config, bool $isValid)
    {
        if (!$isValid) {
            $this->expectException(InvalidConfigurationException::class);
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
        yield [['type' => 'original_source'], true];
        // Redirect flow with redirect url
        yield [['type' => 'original_source', 'flow' => Source::FLOW_REDIRECT, 'redirect' => ['redirect_url' => 'http://here.am/I']], false];

        // ## INVALID
        // Missing amount for single_use source
        yield [['type' => 'original_source', 'usage' => Source::USAGE_SINGLE_USE], false];
        // Receiver is specified but not flow
        yield [['type' => 'original_source', 'receiver' => []], false];
        // Receiver is specified but flow is not the correct one
        yield [['type' => 'original_source', 'receiver' => [], 'flow' => Source::FLOW_NONE], false];
        // Redirect flow without redirect url
        yield [['type' => 'original_source', 'flow' => Source::FLOW_REDIRECT], false];
    }
}
