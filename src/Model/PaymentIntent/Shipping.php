<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\PaymentIntent;

use Shapin\Stripe\Model\Address;
use Shapin\Stripe\Model\CreatableFromArray;

final class Shipping implements CreatableFromArray
{
    /**
     * @var Address
     */
    private $address;

    /**
     * @var ?string
     */
    private $carrier;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var ?string
     */
    private $trackingNumber;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->address = Address::createFromArray($data['address']);
        $model->carrier = $data['carrier'];
        $model->name = $data['name'];
        $model->phone = $data['phone'];
        $model->trackingNumber = $data['tracking_number'];

        return $model;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getCarrier(): ?string
    {
        return $this->carrier;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }
}
