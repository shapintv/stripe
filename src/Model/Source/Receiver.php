<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Source;

use Money\Currency;
use Money\Money;

final class Receiver
{
    /**
     * @var string
     */
    private $address;

    /**
     * @var Money
     */
    private $amountCharged;

    /**
     * @var Money
     */
    private $amountReceived;

    /**
     * @var Money
     */
    private $amountReturned;

    private function __construct()
    {
    }

    public static function createFromArray(array $data, Currency $currency): self
    {
        $model = new self();
        $model->address = $data['address'];
        $model->amountCharged = new Money((int) $data['amount_charged'], $currency);
        $model->amountReceived = new Money((int) $data['amount_received'], $currency);
        $model->amountReturned = new Money((int) $data['amount_returned'], $currency);

        return $model;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getAmountCharged(): Money
    {
        return $this->amountCharged;
    }

    public function getAmountReceived(): Money
    {
        return $this->amountReceived;
    }

    public function getAmountReturned(): Money
    {
        return $this->amountReturned;
    }
}
