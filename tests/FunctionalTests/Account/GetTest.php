<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Api\Account;

use Shapin\Stripe\Model\Account\Account;
use Shapin\Stripe\Model\Account\AccountVerification;
use Shapin\Stripe\Model\Account\ExternalAccountCollection;
use Shapin\Stripe\Model\Account\LegalEntity;
use Shapin\Stripe\Model\Account\LegalEntityVerification;
use Shapin\Stripe\Model\Account\PayoutSchedule;
use Shapin\Stripe\Model\Account\TermsOfServiceAcceptance;
use Shapin\Stripe\Model\Address;
use Shapin\Stripe\Model\Card\Card;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;;

final class GetTest extends TestCase
{
    private $accountApi;

    public function setUp()
    {
        $this->accountApi = $this->getStripeClient()->accounts();
    }

    public function testGet()
    {
        $account = $this->accountApi->get('acct_1C5b6lIpafQncvOM');

        $this->assertInstanceOf(Account::class, $account);

        $this->assertSame('acct_1C5b6lIpafQncvOM', $account->getId());
        $this->assertNull($account->getBusinessLogo());
        $this->assertNull($account->getBusinessName());
        $this->assertNull($account->getBusinessUrl());
        $this->assertSame([], $account->getCapabilities());
        $this->assertFalse($account->areChargesEnabled());
        $this->assertSame('US', $account->getCountry());
        $this->assertSame(1234567890, $account->getCreatedAt()->getTimestamp());
        $this->assertTrue($account->isDebitNegativeBalancesAccepted());
        $this->assertTrue($account->getDeclineChargeOnAvsFailure());
        $this->assertTrue($account->getDeclineChargeOnCvcFailure());
        $this->assertSame('USD', (string) $account->getDefaultCurrency());
        $this->assertFalse($account->areDetailsSubmitted());
        $this->assertNull($account->getDisplayName());
        $this->assertSame('site@stripe.com', $account->getEmail());
        $this->assertInstanceOf(ExternalAccountCollection::class, $account->getExternalAccounts());
        $this->assertCount(1, $account->getExternalAccounts());
        $this->assertInstanceOf(Card::class, $account->getExternalAccounts()[0]);

        $legalEntity = $account->getLegalEntity();
        $this->assertInstanceOf(LegalEntity::class, $legalEntity);
        $this->assertSame([], $legalEntity->getAdditionalOwners());
        $this->assertInstanceOf(Address::class, $legalEntity->getAddress());
        $this->assertNull($legalEntity->getBusinessName());
        $this->assertFalse($legalEntity->isBusinessTaxIdProvided());
        $this->assertNull($legalEntity->getDateOfBirth());
        $this->assertNull($legalEntity->getFirstName());
        $this->assertNull($legalEntity->getLastName());
        $this->assertInstanceOf(Address::class, $legalEntity->getPersonalAddress());
        $this->assertFalse($legalEntity->isPersonalIdNumberProvided());
        $this->assertFalse($legalEntity->areSsnLastFourProvided());
        $this->assertNull($legalEntity->getType());
        $this->assertInstanceOf(LegalEntityVerification::class, $legalEntity->getVerification());
        $this->assertNull($legalEntity->getVerification()->getDetails());
        $this->assertNull($legalEntity->getVerification()->getDetailsCode());
        $this->assertNull($legalEntity->getVerification()->getDocument());
        $this->assertNull($legalEntity->getVerification()->getDocumentBack());
        $this->assertSame('unverified', $legalEntity->getVerification()->getStatus());

        $this->assertInstanceOf(MetadataCollection::class, $account->getMetadata());
        $this->assertCount(0, $account->getMetadata());
        $this->assertInstanceOf(PayoutSchedule::class, $account->getPayoutSchedule());
        $this->assertSame(2, $account->getPayoutSchedule()->getDelayDays());
        $this->assertSame('daily', $account->getPayoutSchedule()->getInterval());
        $this->assertNull($account->getPayoutSchedule()->getMonthlyAnchor());
        $this->assertSame('daily', $account->getPayoutSchedule()->getWeeklyAnchor());
        $this->assertNull($account->getPayoutStatementDescriptor());
        $this->assertFalse($account->arePayoutsEnabled());
        $this->assertNull($account->getProductDescription());
        $this->assertSame('', $account->getStatementDescriptor());
        $this->assertNull($account->getSupportAddress());
        $this->assertNull($account->getSupportEmail());
        $this->assertNull($account->getSupportPhone());
        $this->assertSame('Etc/UTC', $account->getTimezone());
        $this->assertInstanceOf(TermsOfServiceAcceptance::class, $account->getTermsOfServiceAcceptance());
        $this->assertNull($account->getTermsOfServiceAcceptance()->getDate());
        $this->assertNull($account->getTermsOfServiceAcceptance()->getIp());
        $this->assertNull($account->getTermsOfServiceAcceptance()->getUserAgent());
        $this->assertSame('standard', $account->getType());
        $this->assertInstanceOf(AccountVerification::class, $account->getVerification());

        $this->assertSame('fields_needed', $account->getVerification()->getDisabledReason());
        $this->assertNull($account->getVerification()->getDueBy());
        $this->assertCount(16, $account->getVerification()->getFieldsNeeded());
    }
}
