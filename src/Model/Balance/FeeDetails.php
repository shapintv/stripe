<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Balance;

use Shapin\Stripe\Model\CreatableFromArray;
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

    private function __construct() {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->amount = new Money($data['amount'], new Currency($data['currency']));
        $model->application = $data['application'];
        $model->description = $data['description'];
        $model->type = $data['type'];

        return $model;
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
