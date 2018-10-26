<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\BankAccount;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Money\Currency;
use Money\Money;

final class BankAccount implements CreatableFromArray, ContainsMetadata
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
     * @var string
     */
    private $accountHolderName;

    /**
     * @var string
     */
    private $accountHolderType;

    /**
     * @var string
     */
    private $bankName;

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
    private $fingerprint;

    /**
     * @var string
     */
    private $lastFour;

    /**
     * @var string
     */
    private $routingNumber;

    /**
     * @var string
     */
    private $status;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->account = $data['account'] ?? null;
        $model->accountHolderName = $data['account_holder_name'];
        $model->accountHolderType = $data['account_holder_type'];
        $model->bankName = $data['bank_name'];
        $model->country = $data['country'];
        $model->currency = new Currency(strtoupper($data['currency']));
        $model->customer = $data['customer'];
        $model->fingerprint = $data['fingerprint'];
        $model->lastFour = $data['last4'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->routingNumber = $data['routing_number'];
        $model->status = $data['status'];

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

    public function getAccountHolderName(): string
    {
        return $this->accountHolderName;
    }

    public function getAccountHolderType(): string
    {
        return $this->accountHolderType;
    }

    public function getBankName(): string
    {
        return $this->bankName;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function getFingerprint(): string
    {
        return $this->fingerprint;
    }

    public function getLastFour(): string
    {
        return $this->lastFour;
    }

    public function getRoutingNumber(): string
    {
        return $this->routingNumber;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
