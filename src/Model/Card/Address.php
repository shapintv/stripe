<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Model\Card;

use FAPI\Stripe\Model\CreatableFromArray;

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
    private $firstLineCheck;

    /**
     * @var string
     */
    private $secondLine;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $zipCheck;

    public static function createFromArray(array $data)
    {
        $model = new self();
        $model->city = $data['address_city'];
        $model->country = $data['address_country'];
        $model->firstLine = $data['address_line1'];
        $model->firstLineCheck = $data['address_line1_check'];
        $model->secondLine = $data['address_line2'];
        $model->state = $data['address_state'];
        $model->zip = $data['address_zip'];
        $model->zipCheck = $data['address_zip_check'];

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

    public function getFirstLineCheck(): ?string
    {
        return $this->firstLineCheck;
    }

    public function getSecondLine(): ?string
    {
        return $this->secondLine;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function getZipCheck(): ?string
    {
        return $this->zipCheck;
    }
}
