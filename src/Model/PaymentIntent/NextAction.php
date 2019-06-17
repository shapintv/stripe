<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\PaymentIntent;

use Shapin\Stripe\Model\Charge\ChargeCollection;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\Customer\CustomField;
use Shapin\Stripe\Model\Source\Source;
use Money\Currency;
use Money\Money;

final class NextAction implements CreatableFromArray
{
    const TYPE_REDIRECT_TO_URL = 'redirect_to_url';
    const TYPE_USE_STRIPE_SDK = 'use_stripe_sdk';

    /**
     * @var ?array
     */
    private $redirectToUrl;

    /**
     * @var string
     */
    private $type;

    /**
     * @var ?array
     */
    private $useStripeSDK;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->redirectToUrl = $data['redirect_to_url'];
        $model->type = $data['type'];
        $model->useStripeSDK = $data['use_stripe_sdk'];

        return $model;
    }

    public function getRedirectToUrl(): ?array
    {
        return $this->redirectToUrl;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getUseStripeSDK(): ?array
    {
        return $this->useStripeSDK;
    }
}
