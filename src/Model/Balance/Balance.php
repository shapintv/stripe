<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Balance;

use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\LivemodeTrait;

final class Balance implements CreatableFromArray
{
    use LivemodeTrait;

    /**
     * @var BalancePart[]
     */
    private $available;

    /**
     * @var BalancePart[]
     */
    private $connectReserved;

    /**
     * @var BalancePart[]
     */
    private $pending;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $available = [];
        foreach ($data['available'] as $part) {
            $available[] = BalancePart::createFromArray($part);
        }

        $connectReserved = [];
        foreach ($data['connect_reserved'] as $part) {
            $connectReserved[] = BalancePart::createFromArray($part);
        }

        $pending = [];
        foreach ($data['pending'] as $part) {
            $pending[] = BalancePart::createFromArray($part);
        }

        $model = new self();
        $model->available = $available;
        $model->connectReserved = $connectReserved;
        $model->pending = $pending;
        $model->live = (bool) $data['livemode'];

        return $model;
    }

    public function getAvailable(): array
    {
        return $this->available;
    }

    public function getConnectReserved(): array
    {
        return $this->connectReserved;
    }

    public function getPending(): array
    {
        return $this->pending;
    }
}
