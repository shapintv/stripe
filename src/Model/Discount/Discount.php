<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Discount;

use Shapin\Stripe\Model\Coupon\Coupon;
use Shapin\Stripe\Model\CreatableFromArray;

final class Discount implements CreatableFromArray
{
    /**
     * @var Coupon
     */
    private $coupon;

    /**
     * @var string
     */
    private $customer;

    /**
     * @var ?\DateTimeImmutable
     */
    private $endAt;

    /**
     * @var \DateTimeImmutable
     */
    private $startAt;

    /**
     * @var string
     */
    private $subscription;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->coupon = Coupon::createFromArray($data['coupon']);
        $model->customer = $data['customer'];
        $model->endAt = isset($data['end']) ? new \DateTimeImmutable('@'.$data['end']) : null;
        $model->startAt = new \DateTimeImmutable('@'.$data['start']);
        $model->subscription = $data['subscription'];

        return $model;
    }

    public function isEnded(): bool
    {
        return $this->endAt < new \DateTimeImmutable();
    }

    public function getCoupon(): Coupon
    {
        return $this->coupon;
    }

    public function getCustomer(): string
    {
        return $this->customer;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->endAt;
    }

    public function getStartAt(): \DateTimeImmutable
    {
        return $this->startAt;
    }

    public function getSubscription(): string
    {
        return $this->subscription;
    }
}
