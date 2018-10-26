<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Source;

use Shapin\Stripe\Model\Address;
use Shapin\Stripe\Model\CreatableFromArray;

final class Owner implements CreatableFromArray
{
    /**
     * @var ?Address
     */
    private $address;

    /**
     * @var string
     */
    private $email;

    /**
     * @var ?string
     */
    private $name;

    /**
     * @var ?string
     */
    private $phone;

    /**
     * @var ?Address
     */
    private $verifiedAddress;

    /**
     * @var ?string
     */
    private $verifiedEmail;

    /**
     * @var ?string
     */
    private $verifiedName;

    /**
     * @var ?string
     */
    private $verifiedPhone;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->address = null !== $data['address'] ? Address::createFromArray($data['address']) : null;
        $model->email = $data['email'];
        $model->name = $data['name'];
        $model->phone = $data['phone'];
        $model->verifiedAddress = null !== $data['verified_address'] ? Address::createFromArray($data['verified_address']) : null;
        $model->verifiedEmail = $data['verified_email'];
        $model->verifiedName = $data['verified_name'];
        $model->verifiedPhone = $data['verified_phone'];

        return $model;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getVerifiedAddress(): ?Address
    {
        return $this->verifiedAddress;
    }

    public function getVerifiedEmail(): ?string
    {
        return $this->verifiedEmail;
    }

    public function getVerifiedName(): ?string
    {
        return $this->verifiedName;
    }

    public function getVerifiedPhone(): ?string
    {
        return $this->verifiedPhone;
    }
}
