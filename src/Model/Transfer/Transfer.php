<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Transfer;

use Money\Currency;
use Money\Money;
use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\LivemodeTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Model\MetadataTrait;

final class Transfer implements CreatableFromArray, ContainsMetadata
{
    use LivemodeTrait;
    use MetadataTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var Money
     */
    private $amountReversed;

    /**
     * @var string
     */
    private $balanceTransaction;

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
    private $description;

    /**
     * @var string
     */
    private $destination;

    /**
     * @var string
     */
    private $destinationPayment;

    /**
     * @var TransferReversalCollection
     */
    private $reversals;

    /**
     * @var bool
     */
    private $reversed;

    /**
     * @var string
     */
    private $sourceTransaction;

    /**
     * @var string
     */
    private $sourceType;

    /**
     * @var string
     */
    private $transferGroup;

    public static function createFromArray(array $data): self
    {
        $currency = new Currency(strtoupper($data['currency']));

        $model = new self();
        $model->id = $data['id'];
        $model->amount = new Money($data['amount'], $currency);
        $model->amountReversed = new Money($data['amount_reversed'], $currency);
        $model->balanceTransaction = $data['balance_transaction'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->currency = $currency;
        $model->description = $data['description'];
        $model->destination = $data['destination'];
        $model->destinationPayment = $data['destination_payment'] ?? null;
        $model->live = (bool) $data['livemode'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->reversals = TransferReversalCollection::createFromArray($data['reversals']);
        $model->reversed = (bool) $data['reversed'];
        $model->sourceTransaction = $data['source_transaction'];
        $model->sourceType = $data['source_type'];
        $model->transferGroup = $data['transfer_group'];

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

    public function getAmountReversed(): Money
    {
        return $this->amountReversed;
    }

    public function getBalanceTransaction(): ?string
    {
        return $this->balanceTransaction;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function getDestinationPayment(): ?string
    {
        return $this->destinationPayment;
    }

    public function getTransferReversals(): TransferReversalCollection
    {
        return $this->reversals;
    }

    public function isReversed(): bool
    {
        return $this->reversed;
    }

    public function getSourceTransaction(): ?string
    {
        return $this->sourceTransaction;
    }

    public function getSourceType(): string
    {
        return $this->sourceType;
    }

    public function getTransferGroup(): ?string
    {
        return $this->transferGroup;
    }
}
