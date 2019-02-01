<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Customer;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\LivemodeTrait;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Model\Source\SourceCollection;
use Shapin\Stripe\Model\Subscription\SubscriptionCollection;
use Money\Currency;

final class Customer implements CreatableFromArray, ContainsMetadata
{
    use LivemodeTrait, MetadataTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var integer
     */
    private $accountBalance;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var string
     */
    private $defaultSource;

    /**
     * @var bool
     */
    private $delinquent;

    /**
     * @var ?string
     */
    private $description;

    /**
     * @var array
     */
    private $discount;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $invoicePrefix;

    /**
     * @var ?InvoiceSettings
     */
    private $invoiceSettings;

    /**
     * @var ?Shipping
     */
    private $shipping;

    /**
     * @var SourceCollection
     */
    private $sources;

    /**
     * @var SubscriptionCollection
     */
    private $subscriptions;

    /**
     * @var TaxInfo
     */
    private $taxInfo;

    /**
     * @var TaxInfoVerification
     */
    private $taxInfoVerification;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->accountBalance = (int) $data['account_balance'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->currency = new Currency(strtoupper($data['currency']));
        $model->defaultSource = $data['default_source'];
        $model->delinquent = (bool) $data['delinquent'];
        $model->description = $data['description'];
        $model->discount = array_key_exists('discount', $data) ? $data['discount'] : null;
        $model->email = $data['email'];
        $model->invoicePrefix = $data['invoice_prefix'];
        $model->invoiceSettings = array_key_exists('invoice_settings', $data) ? InvoiceSettings::createFromArray($data['invoice_settings']) : null;
        $model->live = (bool) $data['livemode'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        if (isset($data['shipping'])) {
            $model->shipping =  Shipping::createFromArray($data['shipping']);
        }
        //$model->sources = SourceCollection::createFromArray($data['sources']);
        //$model->subscriptions = SubscriptionCollection::createFromArray($data['subscriptions']);
        $model->sources = SourceCollection::createFromArray(['data' => [], 'has_more' => false]);
        if (isset($data['tax_info'])) {
            $model->taxInfo = TaxInfo::createFromArray($data['tax_info']);
        }
        if (isset($data['tax_info_verification'])) {
            $model->taxInfoVerification = TaxInfoVerification::createFromArray($data['tax_info_verification']);
        }

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAccountBalance(): int
    {
        return $this->accountBalance;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getDefaultSource(): ?array
    {
        return $this->defaultSource;
    }

    public function isDelinquent(): bool
    {
        return $this->delinquent;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDiscount(): ?array
    {
        return $this->discount;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getInvoicePrefix(): ?string
    {
        return $this->invoicePrefix;
    }

    public function getInvoiceSettings(): ?InvoiceSettings
    {
        return $this->invoiceSettings;
    }

    public function getShipping(): ?Shipping
    {
        return $this->shipping;
    }

    public function getSources(): SourceCollection
    {
        return $this->sources;
    }

    public function getSubscriptions(): SubscriptionCollection
    {
        return $this->subscriptions;
    }

    public function getTaxInfo(): ?TaxInfo
    {
        return $this->taxInfo;
    }

    public function getTaxInfoVerification(): ?TaxInfoVerification
    {
        return $this->taxInfoVerification;
    }
}