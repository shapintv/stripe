<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Invoice;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\LivemodeTrait;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Money\Currency;
use Money\Money;

final class LineItem implements CreatableFromArray, ContainsMetadata
{
    use LivemodeTrait, MetadataTrait;

    const TYPE_INVOICE_ITEM = 'invoiceitem';
    const TYPE_SUBSCRIPTION = 'subscription';

    /**
     * @var string
     */
    private $id;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $description;

    /**
     * @var bool
     */
    private $discountable;

    /**
     * @var ?string
     */
    private $hydraId;

    /**
     * @var ?string
     */
    private $invoiceItem;

    /**
     * @var Period
     */
    private $period;

    /**
     * @var ?string
     */
    private $plan;

    /**
     * @var bool
     */
    private $proration;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var ?string
     */
    private $subscription;

    /**
     * @var ?string
     */
    private $subscriptionItem;

    /**
     * @var ?string
     */
    private $type;

    public static function createFromArray(array $data): self
    {
        $currency = new Currency(strtoupper($data['currency']));

        $model = new self();
        $model->id = $data['id'];
        $model->amount = new Money($data['amount'], $currency);
        $model->currency = $currency;
        $model->description = $data['description'];
        $model->discountable = (bool) $data['discountable'];
        $model->hydraId = $data['hydra_id'] ?? null;
        $model->invoiceItem = $data['invoice_item'] ?? null;
        $model->live = $data['livemode'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->period = Period::createFromArray($data['period']);
        $model->plan = $data['plan'];
        $model->proration = (bool) $data['proration'];
        $model->quantity = (int) $data['quantity'];
        $model->subscription = $data['subscription'];
        $model->subscriptionItem = $data['subscription_item'] ?? null;
        $model->type = $data['type'] ?? null;

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function isDiscountable(): bool
    {
        return $this->discountable;
    }

    public function getHydraId(): ?string
    {
        return $this->hydraId;
    }

    public function getInvoiceItem(): ?string
    {
        return $this->invoiceItem;
    }

    public function getPeriod(): Period
    {
        return $this->period;
    }

    public function getPlan(): ?string
    {
        return $this->plan;
    }

    public function isProration(): bool
    {
        return $this->proration;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getSubscription(): ?string
    {
        return $this->subscription;
    }

    public function getSubscriptionItem(): ?string
    {
        return $this->subscriptionItem;
    }

    public function getType(): ?string
    {
        return $this->type;
    }
}
