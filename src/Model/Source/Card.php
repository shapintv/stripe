<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Source;

use Shapin\Stripe\Model\CreatableFromArray;

final class Card implements CreatableFromArray
{
    const THREE_D_SECURE_REQUIRED = 'required';
    const THREE_D_SECURE_RECOMMENDED = 'recommended';
    const THREE_D_SECURE_OPTIONAL = 'optional';
    const THREE_D_SECURE_NOT_SUPPORTED = 'not_supported';

    /**
     * @var string
     */
    private $addressLine1Check;

    /**
     * @var string
     */
    private $addressZipCheck;

    /**
     * @var string
     */
    private $brand;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $cvcCheck;

    /**
     * @var string
     */
    private $dynamicLastFour;

    /**
     * @var int
     */
    private $expirationMonth;

    /**
     * @var int
     */
    private $expirationYear;

    /**
     * @var string
     */
    private $fingerprint;

    /**
     * @var string
     */
    private $funding;

    /**
     * @var string
     */
    private $lastFour;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $threeDSecure;

    /**
     * @var string
     */
    private $tokenizationMethod;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->addressLine1Check = $data['address_line1_check'];
        $model->addressZipCheck = $data['address_zip_check'];
        $model->brand = $data['brand'];
        $model->country = $data['country'];
        $model->cvcCheck = $data['cvc_check'];
        $model->dynamicLastFour = $data['dynamic_last4'];
        $model->expirationMonth = (int) $data['exp_month'];
        $model->expirationYear = (int) $data['exp_year'];
        $model->fingerprint = $data['fingerprint'];
        $model->funding = $data['funding'];
        $model->lastFour = $data['last4'];
        $model->name = $data['name'];
        $model->threeDSecure = $data['three_d_secure'];
        $model->tokenizationMethod = $data['tokenization_method'];

        return $model;
    }

    public function isThreeDSecureRequired(): bool
    {
        return self::THREE_D_SECURE_REQUIRED === $this->threeDSecure;
    }

    public function isThreeDSecureRecommended(): bool
    {
        return self::THREE_D_SECURE_RECOMMENDED === $this->threeDSecure;
    }

    public function isThreeDSecureOptional(): bool
    {
        return self::THREE_D_SECURE_OPTIONAL === $this->threeDSecure;
    }

    public function isThreeDSecureSupported(): bool
    {
        return self::THREE_D_SECURE_NOT_SUPPORTED !== $this->threeDSecure;
    }

    public function getAddressLine1Check(): ?string
    {
        return $this->addressLine1Check;
    }

    public function getAddressZipCheck(): ?string
    {
        return $this->addressZipCheck;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCvcCheck(): ?string
    {
        return $this->cvcCheck;
    }

    public function getDynamicLastFour(): ?string
    {
        return $this->dynamicLastFour;
    }

    public function getExpirationMonth(): int
    {
        return $this->expirationMonth;
    }

    public function getExpirationYear(): int
    {
        return $this->expirationYear;
    }

    public function getFingerprint(): string
    {
        return $this->fingerprint;
    }

    public function getFunding(): string
    {
        return $this->funding;
    }

    public function getLastFour(): string
    {
        return $this->lastFour;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getThreeDSecure(): string
    {
        return $this->threeDSecure;
    }

    public function getTokenizationMethod(): ?string
    {
        return $this->tokenizationMethod;
    }
}
