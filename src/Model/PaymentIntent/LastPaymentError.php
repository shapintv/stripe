<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\PaymentIntent;

use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\Source\Source;

final class LastPaymentError implements CreatableFromArray
{
    const TYPE_API_CONNECTION_ERROR = 'api_connection_error';
    const TYPE_API_ERROR = 'api_error';
    const TYPE_AUTHENTICATION_ERROR = 'authentication_error';
    const TYPE_CARD_ERROR = 'card_error';
    const TYPE_IDEMPOTENCY_ERROR = 'idempotency_error';
    const TYPE_INVALID_REQUEST_ERROR = 'invalid_request_error';
    const TYPE_RATE_LIMIT_ERROR = 'rate_limit_error';

    /**
     * @var string
     */
    private $type;

    /**
     * @var ?string
     */
    private $chargeId;

    /**
     * @var ?string
     */
    private $code;

    /**
     * @var ?string
     */
    private $declineCode;

    /**
     * @var string
     */
    private $docUrl;

    /**
     * @var ?string
     */
    private $param;

    /**
     * @var ?PaymentIntent
     */
    private $paymentIntent;

    /**
     * @var ?PaymentMethod
     */
    private $paymentMethod;

    /**
     * @var ?Source
     */
    private $source;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->type = $data['type'];
        $model->chargeId = $data['charge_id'];
        $model->code = $data['code'];
        $model->declineCode = $data['decline_code'];
        $model->docUrl = $data['doc_url'];
        $model->message = $data['message'];
        $model->param = $data['param'];
        $model->paymentIntent = isset($data['payment_intent']) ? PaymentIntent::createFromArray($data['payment_method']) : null;
        // TODO: Deal with payment methods
        //$model->paymentMethod = isset($data['payment_method']) ? PaymentMethod::createFromArray($data['payment_method']) : null;
        $model->source = isset($data['source']) ? Source::createFromArray($data['source']) : null;

        return $model;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getChargeId(): ?string
    {
        return $this->charge;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getDeclineCode(): ?string
    {
        return $this->declineCode;
    }

    public function getDocUrl(): ?string
    {
        return $this->docUrl;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getParam(): ?string
    {
        return $this->param;
    }

    public function getPaymentIntent(): ?PaymentIntent
    {
        return $this->paymentIntent;
    }

    public function getPaymentMethod(): ?PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function getSource(): ?Source
    {
        return $this->source;
    }
}
