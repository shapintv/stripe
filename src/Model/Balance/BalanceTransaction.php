<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Model\Balance;

use FAPI\Stripe\Model\CreatableFromArray;
use Money\Currency;
use Money\Money;

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

    private function __construct(
        string $id,
        Money $amount,
        \DateTimeImmutable $availableOn,
        ?string $description,
        ?float $exchangeRate,
        Money $fee,
        array $feeDetails,
        Money $net,
        string $source,
        string $status,
        string $type,
        \DateTimeImmutable $createdAt
    ) {
        $this->id = $id;
        $this->amount = $amount;
        $this->availableOn = $availableOn;
        $this->description = $description;
        $this->exchangeRate = $exchangeRate;
        $this->fee = $fee;
        $this->feeDetails = $feeDetails;
        $this->net = $net;
        $this->source = $source;
        $this->status = $status;
        $this->type = $type;
        $this->createdAt = $createdAt;
    }

    public static function createFromArray(array $data): self
    {
        $currency = new Currency(strtoupper($data['currency']));

        $feeDetails = [];
        foreach ($data['fee_details'] as $feeDetail) {
            $feeDetails[] = FeeDetails::createFromArray($feeDetail);
        }

        return new self(
            $data['id'],
            new Money($data['amount'], $currency),
            new \DateTimeImmutable('@'.$data['available_on']),
            $data['description'],
            $data['exchange_rate'],
            new Money($data['fee'], $currency),
            $feeDetails,
            new Money($data['net'], $currency),
            $data['source'],
            $data['status'],
            $data['type'],
            new \DateTimeImmutable('@'.$data['created'])
        );
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
