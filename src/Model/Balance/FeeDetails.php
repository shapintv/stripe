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

final class FeeDetails implements CreatableFromArray
{
    /**
     * @var Money
     */
    private $amount;

    /**
     * @var string
     */
    private $application;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $type;

    private function __construct(
        Money $amount,
        ?string $application,
        ?string $description,
        string $type
    ) {
        $this->amount = $amount;
        $this->application = $application;
        $this->description = $description;
        $this->type = $type;
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            new Money($data['amount'], new Currency($data['currency'])),
            $data['application'],
            $data['description'],
            $data['type']
        );
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getApplication(): ?string
    {
        return $this->application;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
