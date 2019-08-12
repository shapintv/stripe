<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\SetupIntent;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\Charge\ChargeCollection;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\LivemodeTrait;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Money\Currency;
use Money\Money;

final class SetupIntent implements CreatableFromArray, ContainsMetadata
{
    use LivemodeTrait, MetadataTrait;

    const CANCELLATION_REASON_ABANDONED = 'abandoned';
    const CANCELLATION_REASON_REQUESTED_BY_CUSTOMER = 'requested_by_customer';
    const CANCELLATION_REASON_DUPLICATE = 'duplicate';

    const STATUS_REQUIRES_PAYMENT_METHOD = 'requires_payment_method';
    const STATUS_REQUIRES_CONFIRMATION = 'requires_confirmation';
    const STATUS_REQUIRES_ACTION = 'requires_action';
    const STATUS_PROCESSING = 'processing';
    const STATUS_REQUIRES_CAPTURE = 'requires_capture';
    const STATUS_CANCELED = 'canceled';
    const STATUS_SUCCEEDED = 'succeeded';

    const USAGE_ON_SESSION = 'on_session';
    const USAGE_OFF_SESSION = 'off_session';

    /**
     * @var string
     */
    private $id;

    /**
     * @var ?string
     */
    private $applicationId;

    /**
     * @var ?string
     */
    private $cancellationReason;

    /**
     * @var ?string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $confirmationMethod;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var string
     */
    private $customerId;

    /**
     * @var string
     */
    private $description;

    /**
     * @var ?LastSetupError
     */
    private $lastSetupError;

    /**
     * @var ?NextAction
     */
    private $nextAction;

    /**
     * @var ?string
     */
    private $onBehalfOfId;

    /**
     * @var ?string
     */
    private $paymentMethodId;

    /**
     * @var array
     */
    private $setupMethodTypes;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $usage;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->applicationId = $data['application'];
        $model->cancellationReason = $data['cancellation_reason'] ?? null;
        $model->clientSecret = $data['client_secret'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->customerId = $data['customer'];
        $model->description = $data['description'];
        $model->lastSetupError = isset($data['last_setup_error']) ? LastSetupError::createFromArray($data['last_setup_error']) : null;
        $model->live = $data['livemode'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->nextAction = isset($data['next_action']) ? NextAction::createFromArray($data['next_action']) : null;
        $model->onBehalfOfId = $data['on_behalf_of'];
        $model->paymentMethodId = $data['payment_method'];
        $model->paymentMethodTypes = $data['payment_method_types'];
        $model->status = $data['status'];
        $model->usage = $data['usage'];

        return $model;
    }

    public function requiresAction(): bool
    {
        return self::STATUS_REQUIRES_ACTION === $this->status;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getApplicationId(): ?string
    {
        return $this->applicationId;
    }

    public function getCancellationReason(): ?string
    {
        return $this->cancellationReason;
    }

    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getLastSetupError(): ?LastSetupError
    {
        return $this->lastSetupError;
    }

    public function getNextAction(): ?NextAction
    {
        return $this->nextAction;
    }

    public function getOnBehalfOfId(): ?string
    {
        return $this->onBehalfOfId;
    }

    public function getPaymentMethodId(): ?string
    {
        return $this->paymentMethodId;
    }

    public function getPaymentMethodTypes(): array
    {
        return $this->paymentMethodTypes;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getUsage(): string
    {
        return $this->usage;
    }
}
