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
     * @var string
     */
    private $clientSecret;

    /**
     * @var ?CodeVerification
     */
    private $codeVerification;

    /**
     * @var \DateTimeImmutable
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
     * @var string
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
    private $type;

    /**
     * @var string
     */
    private $usage;

    public static function createFromArray(array $data): self
    {
        $currency = isset($data['currency']) ? new Currency(strtoupper($data['currency'])) : null;

        $model = new self();
        $model->id = $data['id'];
        if (isset($data['ach_credit_transfer'])) {
            $model->achCreditTransfer = AchCreditTransfer::createFromArray($data['ach_credit_transfer']);
        }
        $model->amount = isset($data['amount']) ? new Money($data['amount'], $currency) : null;
        if (isset($data['card'])) {
            $model->card = Card::createFromArray($data['card']);
        }
        $model->clientSecret = $data['client_secret'];
        if (isset($data['code_verification'])) {
            $model->codeVerification = CodeVerification::createFromArray($data['code_verification']);
        }
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->currency = $currency;
        $model->customer = $data['customer'] ?? null;
        $model->flow = $data['flow'];
        $model->live = $data['livemode'];
        $model->metadata = MetadataCollection::createFromArray($data['metadata']);
        $model->owner = Owner::createFromArray($data['owner']);
        if (isset($data['receiver'])) {
            $model->receiver = Receiver::createFromArray($data['receiver'], $currency);
        }
        if (isset($data['redirect'])) {
            $model->redirect = Redirect::createFromArray($data['redirect']);
        }
        $model->statementDescriptor = $data['statement_descriptor'];
        $model->status = $data['status'];
        $model->type = $data['type'];
        $model->usage = $data['usage'];

        return $model;
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

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function getCodeVerification(): ?CodeVerification
    {
        return $this->codeVerification;
    }

    public function getCreatedAt(): \DateTimeImmutable
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

    public function getFlow(): string
    {
        return $this->flow;
    }

    public function getOwner(): Owner
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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getUsage(): string
    {
        return $this->usage;
    }
}
