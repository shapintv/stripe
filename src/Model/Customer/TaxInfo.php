<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Customer;

use Shapin\Stripe\Model\Address;
use Shapin\Stripe\Model\CreatableFromArray;

final class TaxInfo implements CreatableFromArray
{
    /**
     * @var string
     */
    private $taxId;

    /**
     * @var string
     */
    private $type;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->taxId = $data['tax_id'];
        $model->type = $data['type'];

        return $model;
    }

    public function getTaxId(): ?string
    {
        return $this->taxId;
    }

    public function getType(): ?string
    {
        return $this->type;
    }
}
