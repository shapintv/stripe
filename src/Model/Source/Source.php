<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Source;

use Shapin\Stripe\Model\ContainsMetadata;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\LivemodeTrait;
use Shapin\Stripe\Model\MetadataTrait;
use Shapin\Stripe\Model\MetadataCollection;
use Money\Currency;
use Money\Money;

final class Source implements CreatableFromArray, ContainsMetadata
{
    const FLOW_CODE_VERIFICATION = 'code_verification';
    const FLOW_NONE = 'none';
    const FLOW_REDIRECT = 'redirect';
    const FLOW_RECEIVER = 'receiver';

    const NOTIFICATION_METHOD_EMAIL = 'email';
    const NOTIFICATION_METHOD_MANUAL = 'manual';
    const NOTIFICATION_METHOD_NONE = 'none';

    const REFUND_ATTRIBUTES_METHOD_EMAIL = 'email';
    const REFUND_ATTRIBUTES_METHOD_MANUAL = 'manual';

    const STATUS_CANCELED = 'canceled';
    const STATUS_CHARGEABLE = 'chargeable';
    const STATUS_CONSUMED = 'consumed';
    const STATUS_FAILED = 'failed';
    const STATUS_PENDING = 'pending';

    const TYPE_ACH_CREDIT_TRANSFER = 'ach_credit_transfer';
    const TYPE_ACH_DEBIT = 'ach_debit';
    const TYPE_ALIPAY = 'alipay';
    const TYPE_BANCONTACT = 'bancontact';
    const TYPE_CARD = 'card';
    const TYPE_CARD_PRESENT = 'card_present';
    const TYPE_EPS = 'eps';
    const TYPE_GIROPAY = 'giropay';
    const TYPE_IDEAL = 'ideal';
    const TYPE_MULTIBANCO = 'multibanco';
    const TYPE_P24 = 'p24';
    const TYPE_PAPER_CHECK = 'paper_check';
    const TYPE_SEPA_CREDIT_TRANSFER = 'sepa_credit_transfer';
    const TYPE_SEPA_DEBIT = 'sepa_debit';
    const TYPE_SOFORT = 'sofort';
    const TYPE_THREE_D_SECURE = 'three_d_secure';

    const USAGE_REUSABLE = 'reusable';
    const USAGE_SINGLE_USE = 'single_use';

    use LivemodeTrait, MetadataTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var ?AchCreditTransfer
     */
    private $achCreditTransfer;

    /**
     * @var ?Money
     */
    private $amount;

    /**
     * @var ?Card
     */
    private $card;

    /**
     * @var ?string
     */
    private $clientSecret;

    /**
     * @var ?CodeVerification
     */
    private $codeVerification;

    /**
     * @var ?\DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var ?Currency
     */
    private $currency;

    /**
     * @var ?string
     */
    private $customer;

    /**
     * @var ?string
     */
    private $flow;

    /**
     * @var ?Owner
     */
    private $owner;

    /**
     * @var ?Receiver
     */
    private $receiver;

    /**
     * @var ?Redirect
     */
    private $redirect;

    /**
     * @var ?string
     */
    private $statementDescriptor;

    /**
     * @var ?string
     */
    private $status;

    /**
     * @var ?string
     */
    private $type;

    /**
     * @var ?string
     */
    private $usage;

    public static function createFromArray(array $data): self
    {
        $model = new self();

        if (isset($data['currency'])) {
            $currency = new Currency(strtoupper($data['currency']));
            $model->amount = isset($data['amount']) ? new Money($data['amount'], $currency) : null;
            $model->currency = $currency;
            if (isset($data['receiver'])) {
                $model->receiver = Receiver::createFromArray($data['receiver'], $currency);
            }
        }

        $model->id = $data['id'];
        if (isset($data['ach_credit_transfer'])) {
            $model->achCreditTransfer = AchCreditTransfer::createFromArray($data['ach_credit_transfer']);
        }
        if (isset($data['card'])) {
            $model->card = Card::createFromArray($data['card']);
        }
        $model->clientSecret = $data['client_secret'] ?? null;
        if (isset($data['code_verification'])) {
            $model->codeVerification = CodeVerification::createFromArray($data['code_verification']);
        }
        $model->createdAt = isset($data['created']) ? new \DateTimeImmutable('@'.$data['created']) : null;
        $model->customer = $data['customer'] ?? null;
        $model->flow = $data['flow'] ?? null;
        $model->live = $data['livemode'] ?? false;
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->owner = isset($data['owner']) ? Owner::createFromArray($data['owner']) : null;
        if (isset($data['redirect'])) {
            $model->redirect = Redirect::createFromArray($data['redirect']);
        }
        $model->statementDescriptor = $data['statement_descriptor'] ?? null;
        $model->status = $data['status'] ?? null;
        $model->type = $data['type'] ?? null;
        $model->usage = $data['usage'] ?? null;

        return $model;
    }

    public function isThreeDSecure(): bool
    {
        return self::TYPE_THREE_D_SECURE === $this->type;
    }

    public function isCanceled(): bool
    {
        return self::STATUS_CANCELED === $this->status;
    }

    public function isChargeable(): bool
    {
        return self::STATUS_CHARGEABLE === $this->status;
    }

    public function isConsumed(): bool
    {
        return self::STATUS_CONSUMED === $this->status;
    }

    public function isFailed(): bool
    {
        return self::STATUS_FAILED === $this->status;
    }

    public function isPending(): bool
    {
        return self::STATUS_PENDING === $this->status;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAchCreditTransfer(): ?AchCreditTransfer
    {
        return $this->achCreditTransfer;
    }

    public function getAmount(): ?Money
    {
        return $this->amount;
    }

    public function getCard(): ?Card
    {
        return $this->card;
    }

    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }

    public function getCodeVerification(): ?CodeVerification
    {
        return $this->codeVerification;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function getFlow(): ?string
    {
        return $this->flow;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function getReceiver(): ?Receiver
    {
        return $this->receiver;
    }

    public function getRedirect(): ?Redirect
    {
        return $this->redirect;
    }

    public function getStatementDescriptor(): ?string
    {
        return $this->statementDescriptor;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getUsage(): ?string
    {
        return $this->usage;
    }
}
