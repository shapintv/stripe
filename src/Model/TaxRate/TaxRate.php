<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\TaxRate;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\LivemodeTrait;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;

final class TaxRate implements CreatableFromArray, ContainsMetadata
{
    use LivemodeTrait;
    use MetadataTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var bool
     */
    private $isActive;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var ?string
     */
    private $description;

    /**
     * @var string
     */
    private $displayName;

    /**
     * @var bool
     */
    private $isInclusive;

    /**
     * @var ?string
     */
    private $jurisdiction;

    /**
     * @var float
     */
    private $percentage;

    public static function createFromArray(array $data): self
    {
        $model = new self();

        $model->id = $data['id'];
        $model->isActive = (bool) $data['active'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->description = $data['description'];
        $model->displayName = $data['display_name'];
        $model->isInclusive = (bool) $data['inclusive'];
        $model->jurisdiction = $data['jurisdiction'];
        $model->live = $data['livemode'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->percentage = $data['percentage'];

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function isInclusive(): bool
    {
        return $this->isInclusive;
    }

    public function getJurisdiction(): ?string
    {
        return $this->jurisdiction;
    }

    public function getPercentage(): float
    {
        return $this->percentage;
    }
}
