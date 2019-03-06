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

    const BUSINESS_TYPE_INDIVIDUAL = 'individual';
    const BUSINESS_TYPE_COMPANY = 'company';

    const TYPE_CUSTOM = 'custom';
    const TYPE_STANDARD = 'standard';

    /**
     * @var string
     */
    private $id;

    /**
     * @var ?BusinessProfile
     */
    private $businessProfile;

    /**
     * @var ?string
     */
    private $businessType;

    /**
     * @var array
     */
    private $capabilities;

    /**
     * @var bool
     */
    private $chargesEnabled;

    /**
     * @var ?Company
     */
    private $company;

    /**
     * @var string
     */
    private $country;

    /**
     * @var ?\DateTimeImmutable
     */
    private $createdAt;

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
    private $email;

    /**
     * @var ExternalAccountCollection
     */
    private $externalAccounts;

    /**
     * @var ?Individual
     */
    private $individual;

    /**
     * @var bool
     */
    private $payoutsEnabled;

    /**
     * @var ?Requirements
     */
    private $requirements;

    /**
     * @var Settings
     */
    private $settings;

    /**
     * @var ?TermsOfServiceAcceptance
     */
    private $termsOfServiceAcceptance;

    /**
     * @var string
     */
    private $type;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->businessProfile = isset($data['business_profile']) ? BusinessProfile::createFromArray($data['business_profile']) : null;
        $model->businessType = $data['business_type'] ?? null;
        $model->capabilities = $data['capabilities'] ?? [];
        $model->chargesEnabled = (bool) $data['charges_enabled'];
        $model->company = isset($data['company']) ? Company::createFromArray($data['company']) : null;
        $model->country = $data['country'];
        $model->createdAt = isset($data['created']) ? new \DateTimeImmutable('@'.$data['created']) : null;
        $model->defaultCurrency = new Currency(strtoupper($data['default_currency']));
        $model->detailsSubmitted = (bool) $data['details_submitted'];
        $model->email = $data['email'];
        $model->externalAccounts = ExternalAccountCollection::createFromArray($data['external_accounts'] ?? []);
        $model->individual = isset($data['individual']) ? Individual::createFromArray($data['individual']) : null;
        $model->metadata = MetadataCollection::createFromArray($data['metadata'] ?? [] ?? []);
        $model->payoutsEnabled = (bool) $data['payouts_enabled'];
        $model->requirements = isset($data['requirements']) ? Requirements::createFromArray($data['requirements']) : null;
        $model->settings = Settings::createFromArray($data['settings']);
        $model->termsOfServiceAcceptance = isset($data['tos_acceptance']) ? TermsOfServiceAcceptance::createFromArray($data['tos_acceptance']) : null;
        $model->type = $data['type'];

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getBusinessProfile(): ?BusinessProfile
    {
        return $this->businessProfile;
    }

    public function getBusinessType(): ?string
    {
        return $this->businessType;
    }

    public function getCapabilities(): array
    {
        return $this->capabilities;
    }

    public function areChargesEnabled(): bool
    {
        return $this->chargesEnabled;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getDefaultCurrency(): Currency
    {
        return $this->defaultCurrency;
    }

    public function areDetailsSubmitted(): bool
    {
        return $this->detailsSubmitted;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getExternalAccounts(): ExternalAccountCollection
    {
        return $this->externalAccounts;
    }

    public function getIndividual(): ?Individual
    {
        return $this->individual;
    }

    public function arePayoutsEnabled(): bool
    {
        return $this->payoutsEnabled;
    }

    public function getRequirements(): ?Requirements
    {
        return $this->requirements;
    }

    public function getSettings(): Settings
    {
        return $this->settings;
    }

    public function getTermsOfServiceAcceptance(): ?TermsOfServiceAcceptance
    {
        return $this->termsOfServiceAcceptance;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
