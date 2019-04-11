<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Charge;

use Shapin\Stripe\Model\Account\Account;
use Shapin\Stripe\Model\Card\Card;
use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\LivemodeTrait;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Model\Refund\RefundCollection;
use Shapin\Stripe\Model\Source\Source;
use Money\Currency;
use Money\Money;

final class Charge implements CreatableFromArray, ContainsMetadata
{
    use LivemodeTrait, MetadataTrait;

    const STATUS_FAILED = 'failed';
    const STATUS_PENDING = 'pending';
    const STATUS_SUCCEEDED = 'succeeded';

    /**
     * @var string
     */
    private $id;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var Money
     */
    private $amountRefunded;

    /**
     * @var string
     */
    private $application;

    /**
     * @var Money
     */
    private $applicationFee;

    /**
     * @var ?string
     */
    private $balanceTransaction;

    /**
     * @var bool
     */
    private $captured;

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
    private $customer;

    /**
     * @var string
     */
    private $description;

    /**
     * @var ?string
     */
    private $destination;

    /**
     * @var string
     */
    private $dispute;

    /**
     * @var string
     */
    private $failureCode;

    /**
     * @var string
     */
    private $failureMessage;

    /**
     * @var array
     */
    private $fraudDetails;

    /**
     * @var string
     */
    private $invoice;

    /**
     * @var string
     */
    private $onBehalfOf;

    /**
     * @var string
     */
    private $order;

    /**
     * @var ?Outcome
     */
    private $outcome;

    /**
     * @var bool
     */
    private $paid;

    /**
     * @var string
     */
    private $paymentIntent;

    /**
     * @var string
     */
    private $receiptEmail;

    /**
     * @var string
     */
    private $receiptNumber;

    /**
     * @var string
     */
    private $receiptUrl;

    /**
     * @var bool
     */
    private $refunded;

    /**
     * @var RefundCollection
     */
    private $refunds;

    /**
     * @var string
     */
    private $review;

    /**
     * @var array
     */
    private $shipping;

    /**
     * @var mixed
     */
    private $source;

    /**
     * @var string
     */
    private $sourceTransfer;

    /**
     * @var string
     */
    private $statementDescriptor;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $transfer;

    /**
     * @var string
     */
    private $transferGroup;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $currency = new Currency(strtoupper($data['currency']));

        // Most of the time, the source is a card
        // @see: https://stripe.com/docs/api/charges/object?lang=curl#charge_object-source
        $source = $data['source'];
        if (isset($source['object'])) {
            if ('card' === $source['object']) {
                $source = Card::createFromArray($source);
            } elseif ('account' === $source['object']) {
                $source = Account::createFromArray($source);
            } elseif ('source' === $source['object']) {
                $source = Source::createFromArray($source);
            }
        }

        $model = new self();
        $model->id = $data['id'];
        $model->amount = new Money($data['amount'], $currency);
        $model->amountRefunded = new Money($data['amount_refunded'], $currency);
        $model->application = $data['application'];
        $model->applicationFee = null !== $data['application_fee'] ? new Money($data['application_fee'], $currency) : new Money(0, $currency);
        $model->balanceTransaction = $data['balance_transaction'];
        $model->captured = (bool) $data['captured'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->currency = $currency;
        $model->customer = $data['customer'];
        $model->description = $data['description'];
        $model->destination = $data['destination'] ?? null;
        $model->dispute = $data['dispute'];
        $model->failureCode = $data['failure_code'];
        $model->failureMessage = $data['failure_message'];
        $model->fraudDetails = $data['fraud_details']; // TODO: It's a hash. Make something better than just keeping it as is.
        $model->invoice = $data['invoice'];
        $model->live = (bool) $data['livemode'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->onBehalfOf = $data['on_behalf_of'];
        $model->order = $data['order'];
        $model->outcome = null !== $data['outcome'] ? Outcome::createFromArray($data['outcome']) : null;
        $model->paid = (bool) $data['paid'];
        $model->paymentIntent = $data['payment_intent'];
        $model->receiptEmail = $data['receipt_email'];
        $model->receiptNumber = $data['receipt_number'];
        $model->receiptUrl = $data['receipt_url'] ?? null;
        $model->refunded = (bool) $data['refunded'];
        $model->refunds = RefundCollection::createFromArray($data['refunds']);
        $model->review = $data['review'];
        $model->shipping = $data['shipping']; // TODO: It's a hash. Make something better than just keeping it as is.
        $model->source = $source;
        $model->sourceTransfer = $data['source_transfer'];
        $model->statementDescriptor = $data['statement_descriptor'];
        $model->status = $data['status'];
        $model->transfer = $data['transfer'] ?? null;
        $model->transferGroup = $data['transfer_group'];

        return $model;
    }

    public function isFailed(): bool
    {
        return self::STATUS_FAILED === $this->status;
    }

    public function isSucceeded(): bool
    {
        return self::STATUS_SUCCEEDED === $this->status;
    }

    public function isPending(): bool
    {
        return self::STATUS_PENDING === $this->status;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getAmountRefunded(): Money
    {
        return $this->amountRefunded;
    }

    public function getApplication(): ?string
    {
        return $this->application;
    }

    public function getApplicationFee(): Money
    {
        return $this->applicationFee;
    }

    public function getBalanceTransaction(): ?string
    {
        return $this->balanceTransaction;
    }

    public function isCaptured(): bool
    {
        return $this->captured;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function getDispute(): ?string
    {
        return $this->dispute;
    }

    public function getFailureCode(): ?string
    {
        return $this->failureCode;
    }

    public function getFailureMessage(): ?string
    {
        return $this->failureMessage;
    }

    public function getFraudDetails(): array
    {
        return $this->fraudDetails;
    }

    public function getInvoice(): ?string
    {
        return $this->invoice;
    }

    public function getOnBehalfOf(): ?string
    {
        return $this->onBehalfOf;
    }

    public function getOrder(): ?string
    {
        return $this->order;
    }

    public function getOutcome(): ?Outcome
    {
        return $this->outcome;
    }

    public function isPaid(): bool
    {
        return $this->paid;
    }

    public function getPaymentIntent(): ?string
    {
        return $this->paymentIntent;
    }

    public function getReceiptEmail(): ?string
    {
        return $this->receiptEmail;
    }

    public function getReceiptNumber(): ?string
    {
        return $this->receiptNumber;
    }

    public function getReceiptUrl(): ?string
    {
        return $this->receiptUrl;
    }

    public function isRefunded(): bool
    {
        return $this->refunded;
    }

    public function getRefunds(): RefundCollection
    {
        return $this->refunds;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    public function getShipping(): ?array
    {
        return $this->shipping;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function getSourceTransfer(): ?string
    {
        return $this->sourceTransfer;
    }

    public function getStatementDescriptor(): ?string
    {
        return $this->statementDescriptor;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getTransfer(): ?string
    {
        return $this->transfer;
    }

    public function getTransferGroup(): ?string
    {
        return $this->transferGroup;
    }
}
