<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model;

use Shapin\Stripe\Model\CreatableFromArray;

final class Address implements CreatableFromArray
{
    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $firstLine;

    /**
     * @var string
     */
    private $secondLine;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $state;

    public static function createFromArray(array $data)
    {
        $model = new self();
        $model->city = $data['city'];
        $model->country = $data['country'];
        $model->firstLine = $data['line1'];
        $model->secondLine = $data['line2'];
        $model->postalCode = $data['postal_code'];
        $model->state = $data['state'];

        return $model;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getFirstLine(): ?string
    {
        return $this->firstLine;
    }

    public function getSecondLine(): ?string
    {
        return $this->secondLine;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function getState(): ?string
    {
        return $this->state;
    }
}
