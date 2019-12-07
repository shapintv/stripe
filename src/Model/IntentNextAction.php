<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model;

final class IntentNextAction implements CreatableFromArray
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
        $model->redirectToUrl = $data['redirect_to_url'] ?? null;
        $model->type = $data['type'];
        $model->useStripeSDK = $data['use_stripe_sdk'] ?? null;

        return $model;
    }

    public function useStripeSDK(): bool
    {
        return self::TYPE_USE_STRIPE_SDK === $this->type;
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
