<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Account;

use Shapin\Stripe\Model\Account\Account;
use Shapin\Stripe\Model\Account\BusinessProfile;
use Shapin\Stripe\Model\Account\ExternalAccountCollection;
use Shapin\Stripe\Model\Account\Requirements;
use Shapin\Stripe\Model\Account\Settings;
use Shapin\Stripe\Model\Account\TermsOfServiceAcceptance;
use Shapin\Stripe\Model\BankAccount\BankAccount;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class GetTest extends TestCase
{
    private $accountApi;

    public function setUp(): void
    {
        $this->accountApi = $this->getStripeClient()->accounts();
    }

    public function testGet()
    {
        $account = $this->accountApi->get('acct_1C5b6lIpafQncvOM');

        $this->assertInstanceOf(Account::class, $account);

        $this->assertSame('acct_1C5b6lIpafQncvOM', $account->getId());
        $businessProfile = $account->getBusinessProfile();
        $this->assertInstanceOf(BusinessProfile::class, $businessProfile);
        $this->assertNull($businessProfile->getMerchantCategoryCode());
        $this->assertNull($businessProfile->getName());
        $this->assertNull($businessProfile->getProductDescription());
        $this->assertNull($businessProfile->getSupportAddress());
        $this->assertNull($businessProfile->getSupportEmail());
        $this->assertNull($businessProfile->getSupportPhone());
        $this->assertNull($businessProfile->getSupportUrl());
        $this->assertNull($businessProfile->getUrl());
        $this->assertNull($account->getBusinessType());
        $this->assertSame(['card_payments' => 'active', 'transfers' => 'active'], $account->getCapabilities());
        $this->assertFalse($account->areChargesEnabled());
        $this->assertSame('US', $account->getCountry());
        $this->assertSame(1234567890, $account->getCreatedAt()->getTimestamp());
        $this->assertSame('USD', (string) $account->getDefaultCurrency());
        $this->assertFalse($account->areDetailsSubmitted());
        $this->assertSame('site@stripe.com', $account->getEmail());
        $this->assertInstanceOf(ExternalAccountCollection::class, $account->getExternalAccounts());
        $this->assertCount(1, $account->getExternalAccounts());
        $this->assertInstanceOf(BankAccount::class, $account->getExternalAccounts()[0]);
        $this->assertInstanceOf(MetadataCollection::class, $account->getMetadata());
        $this->assertCount(0, $account->getMetadata());
        $this->assertNull($account->getIndividual());
        $this->assertFalse($account->arePayoutsEnabled());
        $requirements = $account->getRequirements();
        $this->assertInstanceOf(Requirements::class, $requirements);
        $this->assertNull($requirements->getCurrentDeadline());
        $this->assertCount(6, $requirements->getCurrentlyDue());
        $this->assertSame('requirements.past_due', $requirements->getDisabledReason());
        $this->assertCount(6, $requirements->getEventuallyDue());
        $this->assertCount(0, $requirements->getPastDue());
        $settings = $account->getSettings();
        $this->assertInstanceOf(Settings::class, $settings);
        $this->assertInstanceOf(TermsOfServiceAcceptance::class, $account->getTermsOfServiceAcceptance());
        $this->assertNull($account->getTermsOfServiceAcceptance()->getDate());
        $this->assertNull($account->getTermsOfServiceAcceptance()->getIp());
        $this->assertNull($account->getTermsOfServiceAcceptance()->getUserAgent());
        $this->assertSame('standard', $account->getType());
    }
}
