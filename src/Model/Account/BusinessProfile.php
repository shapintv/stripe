<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Account;

use Shapin\Stripe\Model\Address;
use Shapin\Stripe\Model\CreatableFromArray;

final class BusinessProfile implements CreatableFromArray
{
    /**
     * @var ?string
     */
    private $merchantCategoryCode;

    /**
     * @var ?string
     */
    private $name;

    /**
     * @var ?string
     */
    private $productDescription;

    /**
     * @var ?Address
     */
    private $supportAddress;

    /**
     * @var ?string
     */
    private $supportEmail;

    /**
     * @var ?string
     */
    private $supportPhone;

    /**
     * @var ?string
     */
    private $supportUrl;

    /**
     * @var ?string
     */
    private $url;

    public static function createFromArray(array $data)
    {
        $model = new self();
        $model->merchantCategoryCode = $data['mcc'];
        $model->name = $data['name'];
        $model->productDescription = $data['product_description'] ?? null;
        $model->supportAddress = isset($data['support_address']) ? Address::createFromArray($data['support_address']) : null;
        $model->supportEmail = $data['support_email'];
        $model->supportPhone = $data['support_phone'];
        $model->supportUrl = $data['support_url'];
        $model->url = $data['url'];

        return $model;
    }

    public function getMerchantCategoryCode(): ?string
    {
        return $this->merchantCategoryCode;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getProductDescription(): ?string
    {
        return $this->productDescription;
    }

    public function getSupportAddress(): ?Address
    {
        return $this->supportAddress;
    }

    public function getSupportEmail(): ?string
    {
        return $this->supportEmail;
    }

    public function getSupportPhone(): ?string
    {
        return $this->supportPhone;
    }

    public function getSupportUrl(): ?string
    {
        return $this->supportUrl;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}
