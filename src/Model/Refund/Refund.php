<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Refund;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Money\Currency;
use Money\Money;

final class Refund implements CreatableFromArray, ContainsMetadata
{
    use MetadataTrait;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var string
     */
    private $balanceTransaction;

    /**
     * @var string
     */
    private $charge;

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
    private $failureBalanceTransaction;

    /**
     * @var string
     */
    private $failureReason;

    /**
     * @var string
     */
    private $reason;

    /**
     * @var string
     */
    private $receiptNumber;

    /**
     * @var string
     */
    private $sourceTransferReversal;

    /**
     * @var string
     */
    private $status;

    public static function createFromArray(array $data): self
    {
        $currency = new Currency(strtoupper($data['currency']));

        $model = new self();
        $model->amount = new Money($data['amount'], $currency);
        $model->balanceTransaction = $data['balance_transaction'];
        $model->charge = $data['charge'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->currency = $currency;
        $model->failureBalanceTransaction = $data['failure_balance_transaction'] ?? null;
        $model->failureReason = $data['failure_reason'] ?? null;
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->reason = $data['reason'];
        $model->receiptNumber = $data['receipt_number'];
        $model->sourceTransferReversal = $data['source_transfer_reversal'] ?? null;
        $model->status = $data['status'];

        return $model;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getBalanceTransaction(): ?string
    {
        return $this->balanceTransaction;
    }

    public function getCharge(): string
    {
        return $this->charge;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getFailureBalanceTransaction(): ?string
    {
        return $this->failureBalanceTransaction;
    }

    public function getFailureReason(): ?string
    {
        return $this->failureReason;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function getReceiptNumber(): ?string
    {
        return $this->receiptNumber;
    }

    public function getSourceTransferReversal(): ?string
    {
        return $this->sourceTransferReversal;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
