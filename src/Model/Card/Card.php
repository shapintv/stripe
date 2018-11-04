<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Card;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Money\Currency;

final class Card implements CreatableFromArray, ContainsMetadata
{
    use MetadataTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $account;

    /**
     * @var Address
     */
    private $address;

    /**
     * @var ?array
     */
    private $availablePayoutMethods;

    /**
     * @var string
     */
    private $brand;

    /**
     * @var string
     */
    private $country;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var string
     */
    private $customer;

    /**
     * @var string
     */
    private $cvcCheck;

    /**
     * @var ?bool
     */
    private $defaultForCurrency;

    /**
     * @var string
     */
    private $dynamicLastFour;

    /**
     * @var int
     */
    private $expirationMonth;

    /**
     * @var int
     */
    private $expirationYear;

    /**
     * @var string
     */
    private $fingerprint;

    /**
     * @var string
     */
    private $funding;

    /**
     * @var string
     */
    private $lastFour;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $recipient;

    /**
     * @var string
     */
    private $tokenizationMethod;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->account = $data['account'] ?? null;
        $model->address = Address::createFromArray($data);
        $model->availablePayoutMethods = $data['available_payout_methods'] ?? null;
        $model->brand = $data['brand'];
        $model->country = $data['country'];
        $model->currency = isset($data['currency']) ? new Currency(strtoupper($data['currency'])) : null;
        $model->customer = $data['customer'];
        $model->cvcCheck = $data['cvc_check'];
        $model->defaultForCurrency = isset($data['default_for_currency']) ? (bool) $data['default_for_currency'] : null;
        $model->dynamicLastFour = $data['dynamic_last4'];
        $model->expirationMonth = (int) $data['exp_month'];
        $model->expirationYear = (int) $data['exp_year'];
        $model->fingerprint = $data['fingerprint'];
        $model->funding = $data['funding'];
        $model->lastFour = $data['last4'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->name = $data['name'];
        $model->recipient = $data['recipient'] ?? null;
        $model->tokenizationMethod = $data['tokenization_method'];

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAccount(): ?string
    {
        return $this->account;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getAvailablePayoutMethods(): ?array
    {
        return $this->availablePayoutMethods;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function getCvcCheck(): ?string
    {
        return $this->cvcCheck;
    }

    public function getDefaultForCurrency(): ?bool
    {
        return $this->defaultForCurrency;
    }

    public function getDynamicLastFour(): ?string
    {
        return $this->dynamicLastFour;
    }

    public function getExpirationMonth(): int
    {
        return $this->expirationMonth;
    }

    public function getExpirationYear(): int
    {
        return $this->expirationYear;
    }

    public function getFingerprint(): string
    {
        return $this->fingerprint;
    }

    public function getFunding(): string
    {
        return $this->funding;
    }

    public function getLastFour(): string
    {
        return $this->lastFour;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRecipient(): ?string
    {
        return $this->recipient;
    }

    public function getTokenizationMethod(): ?string
    {
        return $this->tokenizationMethod;
    }
}
