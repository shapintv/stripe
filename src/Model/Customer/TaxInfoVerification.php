<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Customer;

use Shapin\Stripe\Model\Address;
use Shapin\Stripe\Model\CreatableFromArray;

final class TaxInfoVerification implements CreatableFromArray
{
    const STATUS_UNVERIFIED = 'unverified';
    const STATUS_PENDING = 'pending';
    const STATUS_VERIFIED = 'verified';

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $verifiedName;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->status = $data['status'];
        $model->verifiedName = $data['verified_name'];

        return $model;
    }

    public function isUnverified(): bool
    {
        return self::STATUS_UNVERIFIED === $this->status;
    }

    public function isPending(): bool
    {
        return self::STATUS_PENDING === $this->status;
    }

    public function isVerified(): bool
    {
        return self::STATUS_VERIFIED === $this->status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getVerifiedName(): ?string
    {
        return $this->verifiedName;
    }
}
