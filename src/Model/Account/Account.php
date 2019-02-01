<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Account;

use Shapin\Stripe\Model\Address;
use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Money\Currency;

final class Account implements CreatableFromArray, ContainsMetadata
{
    use MetadataTrait;

    const TYPE_CUSTOM = 'custom';
    const TYPE_STANDARD = 'standard';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $businessLogo;

    /**
     * @var string
     */
    private $businessName;

    /**
     * @var string
     */
    private $businessUrl;

    /**
     * @var array
     */
    private $capabilities;

    /**
     * @var bool
     */
    private $chargesEnabled;

    /**
     * @var string
     */
    private $country;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var ?bool
     */
    private $debitNegativeBalances;

    /**
     * @var ?bool
     */
    private $declineChargeOnAvsFailure;

    /**
     * @var ?bool
     */
    private $declineChargeOnCvcFailure;

    /**
     * @var Currency
     */
    private $defaultCurrency;

    /**
     * @var bool
     */
    private $detailsSubmitted;

    /**
     * @var string
     */
    private $displayName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var ExternalAccountCollection
     */
    private $externalAccounts;

    /**
     * @var LegalEntity
     */
    private $legalEntity;

    /**
     * @var ?PayoutSchedule
     */
    private $payoutSchedule;

    /**
     * @var ?string
     */
    private $payoutStatementDescriptor;

    /**
     * @var bool
     */
    private $payoutsEnabled;

    /**
     * @var string
     */
    private $productDescription;

    /**
     * @var string
     */
    private $statementDescriptor;

    /**
     * @var Address
     */
    private $supportAddress;

    /**
     * @var string
     */
    private $supportEmail;

    /**
     * @var string
     */
    private $supportPhone;

    /**
     * @var string
     */
    private $timezone;

    /**
     * @var TermsOfServiceAcceptance
     */
    private $termsOfServiceAcceptance;

    /**
     * @var string
     */
    private $type;

    /**
     * @var ?AccountVerification
     */
    private $verification;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->businessLogo = $data['business_logo'] ?? null;
        $model->businessName = $data['business_name'];
        $model->businessUrl = $data['business_url'];
        $model->capabilities = $data['capabilities'] ?? [];
        $model->chargesEnabled = (bool) $data['charges_enabled'];
        $model->country = $data['country'];
        $model->createdAt = isset($data['created']) ? new \DateTimeImmutable('@'.$data['created']) : null;
        $model->debitNegativeBalances = (bool) $data['debit_negative_balances'];
        if (isset($data['decline_charge_on'])) {
            $model->declineChargeOnAvsFailure = (bool) $data['decline_charge_on']['avs_failure'];
            $model->declineChargeOnCvcFailure = (bool) $data['decline_charge_on']['cvc_failure'];
        }
        $model->defaultCurrency = new Currency(strtoupper($data['default_currency']));
        $model->detailsSubmitted = (bool) $data['details_submitted'];
        $model->displayName = $data['display_name'];
        $model->email = $data['email'];
        $model->externalAccounts = ExternalAccountCollection::createFromArray($data['external_accounts'] ?? []);
        $model->legalEntity = LegalEntity::createFromArray($data['legal_entity']);
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->payoutSchedule = isset($data['payout_schedule']) ? PayoutSchedule::createFromArray($data['payout_schedule']) : null;
        $model->payoutStatementDescriptor = $data['payout_statement_descriptor'];
        $model->payoutsEnabled = (bool) $data['payouts_enabled'];
        $model->productDescription = $data['product_description'];
        $model->statementDescriptor = $data['statement_descriptor'];
        $model->supportAddress = isset($data['support_address']) ? Address::createFromArray($data['support_address']) : null;
        $model->supportEmail = $data['support_email'];
        $model->supportPhone = $data['support_phone'];
        $model->timezone = $data['timezone'];
        $model->termsOfServiceAcceptance = TermsOfServiceAcceptance::createFromArray($data['tos_acceptance']);
        $model->type = $data['type'];
        $model->verification = isset($data['verification']) ? AccountVerification::createFromArray($data['verification']) : null;

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getBusinessLogo(): ?string
    {
        return $this->businessLogo;
    }

    public function getBusinessName(): ?string
    {
        return $this->businessName;
    }

    public function getBusinessUrl(): ?string
    {
        return $this->businessUrl;
    }

    public function getCapabilities(): array
    {
        return $this->capabilities;
    }

    public function areChargesEnabled(): bool
    {
        return $this->chargesEnabled;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function isDebitNegativeBalancesAccepted(): bool
    {
        return $this->debitNegativeBalances;
    }

    public function getDeclineChargeOnAvsFailure(): ?bool
    {
        return $this->declineChargeOnAvsFailure;
    }

    public function getDeclineChargeOnCvcFailure(): ?bool
    {
        return $this->declineChargeOnCvcFailure;
    }

    public function getDefaultCurrency(): Currency
    {
        return $this->defaultCurrency;
    }

    public function areDetailsSubmitted(): bool
    {
        return $this->detailsSubmitted;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getExternalAccounts(): ExternalAccountCollection
    {
        return $this->externalAccounts;
    }

    public function getLegalEntity(): LegalEntity
    {
        return $this->legalEntity;
    }

    public function getPayoutSchedule(): ?PayoutSchedule
    {
        return $this->payoutSchedule;
    }

    public function getPayoutStatementDescriptor(): ?string
    {
        return $this->payoutStatementDescriptor;
    }

    public function arePayoutsEnabled(): bool
    {
        return $this->payoutsEnabled;
    }

    public function getProductDescription(): ?string
    {
        return $this->productDescription;
    }

    public function getStatementDescriptor(): ?string
    {
        return $this->statementDescriptor;
    }

    public function getSupportAddress(): ?Address
    {
        return $this->supportAddress;
    }

    public function getSupportEmail(): ?string
    {
        return $this->supportEmail;
    }

    public function getSupportPhone(): ?string
    {
        return $this->supportPhone;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function getTermsOfServiceAcceptance(): TermsOfServiceAcceptance
    {
        return $this->termsOfServiceAcceptance;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getVerification(): ?AccountVerification
    {
        return $this->verification;
    }

    public function needVerification(): bool
    {
        return null !== $this->verification && 0 < \count($this->verification->getFieldsNeeded());
    }
}
