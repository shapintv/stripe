<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Configuration;

use PHPUnit\Framework\TestCase;
use Shapin\Stripe\Configuration\AccountCreate;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

class AccountCreateTest extends TestCase
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
        $processor->processConfiguration(new AccountCreate(), [$config]);
    }

    public function configProvider()
    {
        // ## VALID
        // Simple example
        yield [['type' => 'custom']];

        // ## INVALID
        // Standard account without email
        yield [['type' => 'standard'], 'Invalid configuration for path "shapin_stripe": An email must be specified to create a standard account.'];
        // Standard account with fields reserved to custom accounts
        yield [['type' => 'standard', 'email' => 'example@mail.org', 'business_logo' => 'logo.png'], 'Invalid configuration for path "shapin_stripe": You can only set "business_logo" for custom accounts.'];
        yield [['type' => 'standard', 'email' => 'example@mail.org', 'business_name' => 'logo.png'], 'Invalid configuration for path "shapin_stripe": You can only set "business_name" for custom accounts.'];
        yield [['type' => 'standard', 'email' => 'example@mail.org', 'business_primary_color' => '#123456'], 'Invalid configuration for path "shapin_stripe": You can only set "business_primary_color" for custom accounts.'];
        yield [['type' => 'standard', 'email' => 'example@mail.org', 'business_url' => 'http://example.org'], 'Invalid configuration for path "shapin_stripe": You can only set "business_url" for custom accounts.'];
        yield [['type' => 'standard', 'email' => 'example@mail.org', 'debit_negative_balances' => true], 'Invalid configuration for path "shapin_stripe": You cannot set "debit_negative_balances" for standard accounts.'];
        yield [['type' => 'standard', 'email' => 'example@mail.org', 'decline_charge_on' => ['avs_failure' => true, 'cvc_failure' => true]], 'Invalid configuration for path "shapin_stripe": You cannot set "decline_charge_on" for standard accounts.'];
        yield [['type' => 'standard', 'email' => 'example@mail.org', 'legal_entity' => []], 'Invalid configuration for path "shapin_stripe": You can only set "legal_entity" for custom accounts.'];
        yield [['type' => 'standard', 'email' => 'example@mail.org', 'payout_schedule' => []], 'Invalid configuration for path "shapin_stripe": You cannot set "payout_schedule" for standard accounts.'];
        yield [['type' => 'standard', 'email' => 'example@mail.org', 'payout_statement_descriptor' => 'invalid'], 'Invalid configuration for path "shapin_stripe": You cannot set "payout_statement_descriptor" for standard accounts.'];
        yield [['type' => 'standard', 'email' => 'example@mail.org', 'product_description' => 'invalid'], 'Invalid configuration for path "shapin_stripe": You can only set "product_description" for custom accounts.'];
        yield [['type' => 'standard', 'email' => 'example@mail.org', 'support_email' => 'support@example.org'], 'Invalid configuration for path "shapin_stripe": You can only set "support_email" for custom accounts.'];
        yield [['type' => 'standard', 'email' => 'example@mail.org', 'support_phone' => 'phone'], 'Invalid configuration for path "shapin_stripe": You can only set "support_phone" for custom accounts.'];
        yield [['type' => 'standard', 'email' => 'example@mail.org', 'support_url' => 'url'], 'Invalid configuration for path "shapin_stripe": You can only set "support_url" for custom accounts.'];
    }
}
