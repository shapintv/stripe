<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Balance;

use Money\Currency;
use Money\Money;
use Shapin\Stripe\Model\CreatableFromArray;

final class BalanceTransaction implements CreatableFromArray
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var \DateTimeImmutable
     */
    private $availableOn;

    /**
     * @var string
     */
    private $description;

    /**
     * @var float
     */
    private $exchangeRate;

    /**
     * @var Money
     */
    private $fee;

    /**
     * @var FeeDetails[]
     */
    private $feeDetails;

    /**
     * @var Money
     */
    private $net;

    /**
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $type;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $currency = new Currency(strtoupper($data['currency']));

        $feeDetails = [];
        foreach ($data['fee_details'] as $feeDetail) {
            $feeDetails[] = FeeDetails::createFromArray($feeDetail);
        }

        $model = new self();
        $model->id = $data['id'];
        $model->amount = new Money($data['amount'], $currency);
        $model->availableOn = new \DateTimeImmutable('@'.$data['available_on']);
        $model->description = $data['description'];
        $model->exchangeRate = $data['exchange_rate'];
        $model->fee = new Money($data['fee'], $currency);
        $model->feeDetails = $feeDetails;
        $model->net = new Money($data['net'], $currency);
        $model->source = $data['source'];
        $model->status = $data['status'];
        $model->type = $data['type'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);

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

    public function getAvailableOn(): \DateTimeImmutable
    {
        return $this->availableOn;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getExchangeRate(): ?float
    {
        return $this->exchangeRate;
    }

    public function getFee(): Money
    {
        return $this->fee;
    }

    public function getFeeDetails(): array
    {
        return $this->feeDetails;
    }

    public function getNet(): Money
    {
        return $this->net;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
