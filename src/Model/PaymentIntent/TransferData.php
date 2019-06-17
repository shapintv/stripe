<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\PaymentIntent;

use Shapin\Stripe\Model\CreatableFromArray;

final class TransferData implements CreatableFromArray
{
    /**
     * @var ?string
     */
    private $destinationId;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->destinationId = $data['destination'];

        return $model;
    }

    public function getDestinationId(): ?string
    {
        return $this->destinationId;
    }
}
