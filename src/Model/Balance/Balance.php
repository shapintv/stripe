<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Model\Balance;

use FAPI\Stripe\Model\CreatableFromArray;
use FAPI\Stripe\Model\LivemodeTrait;

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

    private function __construct(array $available, array $connectReserved, array $pending, bool $live)
    {
        $this->available = $available;
        $this->connectReserved = $connectReserved;
        $this->pending = $pending;
        $this->live = $live;
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

        return new self($available, $connectReserved, $pending, (bool) $data['livemode']);
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
