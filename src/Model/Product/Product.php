<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Product;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\LivemodeTrait;
use Shapin\Stripe\Model\MetadataTrait;

final class Product implements CreatableFromArray, ContainsMetadata
{
    const TYPE_GOOD = 'good';
    const TYPE_SERVICE = 'service';

    use LivemodeTrait;
    use MetadataTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var array
     */
    private $attributes;

    /**
     * @var ?string
     */
    private $caption;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var array
     */
    private $deactivateOn;

    /**
     * @var ?string
     */
    private $description;

    /**
     * @var array
     */
    private $images;

    /**
     * @var string
     */
    private $name;

    /**
     * @var ?PackageDimension
     */
    private $packageDimension;

    /**
     * @var bool
     */
    private $shippable;

    /**
     * @var ?string
     */
    private $statementDescriptor;

    /**
     * @var string
     */
    private $type;

    /**
     * @var ?string
     */
    private $unitLabel;

    /**
     * @var \DateTimeImmutable
     */
    private $updatedAt;

    /**
     * @var ?string
     */
    private $url;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->active = (bool) $data['active'];
        $model->attributes = $data['attributes'];
        $model->caption = $data['caption'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->deactivateOn = $data['deactivate_on'];
        $model->description = $data['description'];
        $model->images = $data['images'];
        $model->name = $data['name'];
        $model->packageDimension = \array_key_exists('package_dimension', $data) ? PackageDimension::createFromArray($data['package_dimension']) : null;
        $model->shippable = (bool) $data['shippable'];
        $model->statementDescriptor = $data['statement_descriptor'];
        $model->type = $data['type'];
        $model->unitLabel = $data['unit_label'];
        $model->updatedAt = new \DateTimeImmutable('@'.$data['updated']);
        $model->url = $data['url'];

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getDeactivateOn(): array
    {
        return $this->deactivateOn;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPackageDimension(): ?PackageDimension
    {
        return $this->packageDimension;
    }

    public function isShippable(): bool
    {
        return $this->shippable;
    }

    public function getStatementDescriptor(): ?string
    {
        return $this->statementDescriptor;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getUnitLabel(): ?string
    {
        return $this->unitLabel;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}
