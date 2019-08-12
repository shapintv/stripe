<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model;

abstract class Intent
{
    const STATUS_REQUIRES_PAYMENT_METHOD = 'requires_payment_method';
    const STATUS_REQUIRES_CONFIRMATION = 'requires_confirmation';
    const STATUS_REQUIRES_ACTION = 'requires_action';
    const STATUS_PROCESSING = 'processing';
    const STATUS_REQUIRES_CAPTURE = 'requires_capture';
    const STATUS_CANCELED = 'canceled';
    const STATUS_SUCCEEDED = 'succeeded';

    /**
     * @var ?IntentNextAction
     */
    protected $nextAction;

    /**
     * @var string
     */
    protected $status;

    public function requiresAction(): bool
    {
        return self::STATUS_REQUIRES_ACTION === $this->status;
    }

    public function getNextAction(): ?IntentNextAction
    {
        return $this->nextAction;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
