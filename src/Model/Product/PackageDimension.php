<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Product;

use Shapin\Stripe\Model\CreatableFromArray;

final class PackageDimension implements CreatableFromArray
{
    /**
     * @var float
     */
    private $height;

    /**
     * @var float
     */
    private $length;

    /**
     * @var float
     */
    private $weight;

    /**
     * @var float
     */
    private $width;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->height = (float) $data['height'];
        $model->length = (float) $data['length'];
        $model->weight = (float) $data['weight'];
        $model->width = (float) $data['width'];

        return $model;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getLength(): float
    {
        return $this->length;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getWidth(): float
    {
        return $this->width;
    }
}
