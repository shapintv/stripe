<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Transfer;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Money\Currency;
use Money\Money;

final class TransferReversal implements CreatableFromArray, ContainsMetadata
{
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
    private $destinationPaymentRefund;

    /**
     * @var string
     */
    private $sourceRefund;

    /**
     * @var string
     */
    private $transfer;

    public static function createFromArray(array $data): self
    {
        $currency = new Currency(strtoupper($data['currency']));

        $model = new self();
        $model->id = $data['id'];
        $model->amount = new Money($data['amount'], $currency);
        $model->balanceTransaction = $data['balance_transaction'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->currency = $currency;
        $model->destinationPaymentRefund = $data['destination_payment_refund'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->sourceRefund = $data['source_refund'];
        $model->transfer = $data['transfer'];

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

    public function getDestinationPaymentRefund(): ?string
    {
        return $this->destinationPaymentRefund;
    }

    public function getSourceRefund(): ?string
    {
        return $this->sourceRefund;
    }

    public function getTransfer(): string
    {
        return $this->transfer;
    }
}
