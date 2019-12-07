<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Subscription;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\Plan\Plan;

final class Item implements CreatableFromArray, ContainsMetadata
{
    use MetadataTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var Plan
     */
    private $plan;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var string
     */
    private $subscription;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->plan = Plan::createFromArray($data['plan']);
        $model->quantity = (int) $data['quantity'];
        $model->subscription = $data['subscription'];

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getPlan(): Plan
    {
        return $this->plan;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getSubscription(): string
    {
        return $this->subscription;
    }
}
