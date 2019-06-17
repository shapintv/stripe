<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\PaymentIntent;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\Charge\ChargeCollection;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\LivemodeTrait;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Money\Currency;
use Money\Money;

final class PaymentIntent implements CreatableFromArray, ContainsMetadata
{
    use LivemodeTrait, MetadataTrait;

    const CAPTURE_METHOD_AUTOMATIC = 'automatic';
    const CAPTURE_METHOD_MANUAL = 'manual';

    const CONFIRMATION_METHOD_AUTOMATIC = 'automatic';
    const CONFIRMATION_METHOD_MANUAL = 'manual';

    const STATUS_REQUIRES_PAYMENT_METHOD = 'requires_payment_method';
    const STATUS_REQUIRES_CONFIRMATION = 'requires_confirmation';
    const STATUS_REQUIRES_ACTION = 'requires_action';
    const STATUS_PROCESSING = 'processing';
    const STATUS_REQUIRES_CAPTURE = 'requires_capture';
    const STATUS_CANCELED = 'canceled';
    const STATUS_SUCCEEDED = 'succeeded';

    /**
     * @var ?string
     */
    private $id;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var Money
     */
    private $amountCapturable;

    /**
     * @var Money
     */
    private $amountReceived;

    /**
     * @var ?string
     */
    private $applicationId;

    /**
     * @var ?Money
     */
    private $applicationFeeAmount;

    /**
     * @var ?\DateTimeImmutable
     */
    private $canceledAt;

    /**
     * @var ?string
     */
    private $cancellationReason;

    /**
     * @var string
     */
    private $captureMethod;

    /**
     * @var ChargeCollection
     */
    private $charges;

    /**
     * @var string
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
     * @var Currency
     */
    private $currency;

    /**
     * @var string
     */
    private $customerId;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $invoiceId;

    /**
     * @var ?LastPaymentError
     */
    private $lastPaymentError;

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
    private $paymentMethodTypes;

    /**
     * @var ?string
     */
    private $receiptEmail;

    /**
     * @var ?string
     */
    private $reviewId;

    /**
     * @var ?Shipping
     */
    private $shipping;

    /**
     * @var ?string
     */
    private $statementDescriptor;

    /**
     * @var string
     */
    private $status;

    /**
     * @var ?TransferData
     */
    private $transferData;

    /**
     * @var ?string
     */
    private $transferGroup;

    public static function createFromArray(array $data): self
    {
        $currency = new Currency(strtoupper($data['currency']));

        $model = new self();
        $model->id = $data['id'];
        $model->amount = new Money($data['amount'], $currency);
        $model->amountCapturable = new Money($data['amount_capturable'], $currency);
        $model->amountReceived = new Money($data['amount_received'], $currency);
        $model->applicationId = $data['application'];
        $model->canceledAt = isset($data['canceled_at']) ? new \DateTimeImmutable('@'.$data['canceled_at']) : null;
        $model->cancellationReason = $data['cancellation_reason'];
        $model->captureMethod = $data['capture_method'];
        $model->charges = ChargeCollection::createFromArray($data['charges']);
        $model->clientSecret = $data['client_secret'];
        $model->confirmationMethod = $data['confirmation_method'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->currency = $currency;
        $model->customerId = $data['customer'];
        $model->description = $data['description'];
        $model->invoiceId = $data['invoice'];
        $model->lastPaymentError = isset($data['last_payment_error']) ? LastPaymentError::createFromArray($data['last_payment_error']) : null;
        $model->live = $data['livemode'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->nextAction = isset($data['next_action']) ? NextAction::createFromArray($data['next_action']) : null;
        $model->onBehalfOfId = $data['on_behalf_of'];
        $model->paymentMethodId = $data['payment_method'];
        $model->paymentMethodTypes = $data['payment_method_types'];
        $model->receiptEmail = $data['receipt_email'];
        $model->reviewId = $data['review'];
        $model->shipping = isset($data['shipping']) ? Shipping::createFromArray($data['shipping']) : null;
        $model->statementDescriptor = $data['statement_descriptor'];
        $model->status = $data['status'];
        $model->transferData = isset($data['transfer_data']) ? TransferData::createFromArray($data['transfer_data']) : null;
        $model->transferGroup = $data['transfer_group'];

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

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getAmountCapturable(): Money
    {
        return $this->amountCapturable;
    }

    public function getAmountReceived(): Money
    {
        return $this->amountReceived;
    }

    public function getApplicationId(): ?string
    {
        return $this->applicationId;
    }

    public function getApplicationFeeAmount(): ?Money
    {
        return $this->applicationFeeAmount;
    }

    public function getCanceledAt(): \DateTimeInterface
    {
        return $this->canceledAt;
    }

    public function getCancellationReason(): ?string
    {
        return $this->cancellationReason;
    }

    public function getCaptureMethod(): string
    {
        return $this->captureMethod;
    }

    public function getCharges(): ChargeCollection
    {
        return $this->charges;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function getConfirmationMethod(): string
    {
        return $this->confirmationMethod;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getInvoiceId(): ?string
    {
        return $this->invoiceId;
    }

    public function getLastPaymentError(): ?LastPaymentError
    {
        return $this->lastPaymentError;
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

    public function getReceiptEmail(): ?string
    {
        return $this->receiptEmail;
    }

    public function getReviewId(): ?string
    {
        return $this->reviewId;
    }

    public function getShipping(): ?Shipping
    {
        return $this->shipping;
    }

    public function getStatementDescriptor(): ?string
    {
        return $this->statementDescriptor;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getTransferData(): ?TransferData
    {
        return $this->transferData;
    }

    public function getTransferGroup(): ?string
    {
        return $this->transferGroup;
    }
}
