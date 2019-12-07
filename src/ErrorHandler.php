<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe;

use Shapin\Stripe\Exception\Domain as DomainExceptions;
use Shapin\Stripe\Exception\DomainException;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class ErrorHandler
{
    public static $errorCodes = [
        'account_already_exists' => DomainExceptions\BadRequestException::class,
        'account_country_invalid_address' => DomainExceptions\BadRequestException::class,
        'account_invalid' => DomainExceptions\BadRequestException::class,
        'account_number_invalid' => DomainExceptions\BadRequestException::class,
        'alipay_upgrade_required' => DomainExceptions\BadRequestException::class,
        'amount_too_large' => DomainExceptions\BadRequestException::class,
        'amount_too_small' => DomainExceptions\BadRequestException::class,
        'api_key_expired' => DomainExceptions\BadRequestException::class,
        'balance_insufficient' => DomainExceptions\BadRequestException::class,
        'bank_account_exists' => DomainExceptions\BadRequestException::class,
        'bank_account_unusable' => DomainExceptions\BadRequestException::class,
        'bank_account_unverified' => DomainExceptions\BadRequestException::class,
        'bitcoin_upgrade_required' => DomainExceptions\BadRequestException::class,
        'charge_already_captured' => DomainExceptions\BadRequestException::class,
        'charge_already_refunded' => DomainExceptions\ChargeAlreadyRefundedException::class,
        'charge_disputed' => DomainExceptions\BadRequestException::class,
        'charge_exceeds_source_limit' => DomainExceptions\BadRequestException::class,
        'charge_expired_for_capture' => DomainExceptions\BadRequestException::class,
        'country_unsupported' => DomainExceptions\BadRequestException::class,
        'coupon_expired' => DomainExceptions\BadRequestException::class,
        'customer_max_subscriptions' => DomainExceptions\BadRequestException::class,
        'email_invalid' => DomainExceptions\BadRequestException::class,
        'expired_card' => DomainExceptions\BadRequestException::class,
        'idempotency_key_in_use' => DomainExceptions\BadRequestException::class,
        'incorrect_address' => DomainExceptions\BadRequestException::class,
        'incorrect_cvc' => DomainExceptions\IncorrectCvcException::class,
        'incorrect_number' => DomainExceptions\IncorrectNumberException::class,
        'incorrect_zip' => DomainExceptions\BadRequestException::class,
        'instant_payouts_unsupported' => DomainExceptions\BadRequestException::class,
        'invalid_card_type' => DomainExceptions\BadRequestException::class,
        'invalid_charge_amount' => DomainExceptions\BadRequestException::class,
        'invalid_cvc' => DomainExceptions\BadRequestException::class,
        'invalid_expiry_month' => DomainExceptions\BadRequestException::class,
        'invalid_expiry_year' => DomainExceptions\BadRequestException::class,
        'invalid_number' => DomainExceptions\BadRequestException::class,
        'invalid_source_usage' => DomainExceptions\BadRequestException::class,
        'invoice_no_customer_line_items' => DomainExceptions\BadRequestException::class,
        'invoice_no_subscription_line_items' => DomainExceptions\BadRequestException::class,
        'invoice_not_editable' => DomainExceptions\BadRequestException::class,
        'invoice_upcoming_none' => DomainExceptions\BadRequestException::class,
        'livemode_mismatch' => DomainExceptions\BadRequestException::class,
        'missing' => DomainExceptions\BadRequestException::class,
        'not_allowed_on_standard_account' => DomainExceptions\BadRequestException::class,
        'order_creation_failed' => DomainExceptions\BadRequestException::class,
        'order_required_settings' => DomainExceptions\BadRequestException::class,
        'order_status_invalid' => DomainExceptions\BadRequestException::class,
        'order_upstream_timeout' => DomainExceptions\BadRequestException::class,
        'out_of_inventory' => DomainExceptions\BadRequestException::class,
        'parameter_invalid_empty' => DomainExceptions\BadRequestException::class,
        'parameter_invalid_integer' => DomainExceptions\BadRequestException::class,
        'parameter_invalid_string_blank' => DomainExceptions\BadRequestException::class,
        'parameter_invalid_string_empty' => DomainExceptions\BadRequestException::class,
        'parameter_missing' => DomainExceptions\BadRequestException::class,
        'parameter_unknown' => DomainExceptions\BadRequestException::class,
        'parameters_exclusive' => DomainExceptions\BadRequestException::class,
        'payment_intent_authentication_failure' => DomainExceptions\BadRequestException::class,
        'payment_intent_incompatible_payment_method' => DomainExceptions\BadRequestException::class,
        'payment_intent_invalid_parameter' => DomainExceptions\BadRequestException::class,
        'payment_intent_payment_attempt_failed' => DomainExceptions\BadRequestException::class,
        'payment_intent_unexpected_state' => DomainExceptions\BadRequestException::class,
        'payment_method_unactivated' => DomainExceptions\BadRequestException::class,
        'payment_method_unexpected_state' => DomainExceptions\BadRequestException::class,
        'payouts_not_allowed' => DomainExceptions\BadRequestException::class,
        'platform_api_key_expired' => DomainExceptions\BadRequestException::class,
        'postal_code_invalid' => DomainExceptions\BadRequestException::class,
        'processing_error' => DomainExceptions\BadRequestException::class,
        'product_inactive' => DomainExceptions\BadRequestException::class,
        'rate_limit' => DomainExceptions\BadRequestException::class,
        'resource_already_exists' => DomainExceptions\ResourceAlreadyExistsException::class,
        'resource_missing' => DomainExceptions\BadRequestException::class,
        'routing_number_invalid' => DomainExceptions\BadRequestException::class,
        'secret_key_required' => DomainExceptions\BadRequestException::class,
        'sepa_unsupported_account' => DomainExceptions\BadRequestException::class,
        'shipping_calculation_failed' => DomainExceptions\BadRequestException::class,
        'sku_inactive' => DomainExceptions\BadRequestException::class,
        'state_unsupported' => DomainExceptions\BadRequestException::class,
        'tax_id_invalid' => DomainExceptions\BadRequestException::class,
        'taxes_calculation_failed' => DomainExceptions\BadRequestException::class,
        'testmode_charges_only' => DomainExceptions\BadRequestException::class,
        'tls_version_unsupported' => DomainExceptions\BadRequestException::class,
        'token_already_used' => DomainExceptions\BadRequestException::class,
        'token_in_use' => DomainExceptions\BadRequestException::class,
        'transfers_not_allowed' => DomainExceptions\BadRequestException::class,
        'upstream_order_creation_failed' => DomainExceptions\BadRequestException::class,
        'url_invalid' => DomainExceptions\BadRequestException::class,
    ];

    public static $cardDeclinedCodes = [
        'card_not_supported' => DomainExceptions\CardDeclined\CardNotSupportedException::class,
        'expired_card' => DomainExceptions\CardDeclined\ExpiredCardException::class,
        'incorrect_cvc' => DomainExceptions\CardDeclined\IncorrectCvcException::class,
        'incorrect_number' => DomainExceptions\CardDeclined\IncorrectNumberException::class,
        'invalid_cvc' => DomainExceptions\CardDeclined\IncorrectCvcException::class,
        'invalid_number' => DomainExceptions\CardDeclined\IncorrectNumberException::class,
        'insufficient_funds' => DomainExceptions\CardDeclined\InsufficientFundsException::class,
    ];

    public function handle(ResponseInterface $response): void
    {
        $data = json_decode($response->getContent(false), true);

        if (\JSON_ERROR_NONE !== json_last_error()) {
            throw $this->getExceptionForStatusCode($response);
        }

        if (!\array_key_exists('error', $data)) {
            throw $this->getExceptionForStatusCode($response);
        }

        if (!\array_key_exists('code', $data['error'])) {
            throw $this->getExceptionForStatusCode($response);
        }

        $errorCode = $data['error']['code'];

        if (\array_key_exists($errorCode, self::$errorCodes)) {
            throw new self::$errorCodes[$errorCode]($response);
        }

        // We have a lot of decline codes for "card_declined" errors.
        if ('card_declined' === $errorCode) {
            $declineCode = $data['error']['decline_code'];

            if (\array_key_exists($declineCode, self::$cardDeclinedCodes)) {
                throw new self::$cardDeclinedCodes[$declineCode]($response);
            }

            throw new DomainExceptions\CardDeclinedException($response);
        }

        throw $this->getExceptionForStatusCode($response);
    }

    private function getExceptionForStatusCode(ResponseInterface $response): DomainException
    {
        switch ($response->getStatusCode()) {
            case 400:
                return new DomainExceptions\BadRequestException($response);
            case 404:
                return new DomainExceptions\NotFoundException();
            default:
                return new DomainExceptions\UnknownErrorException($response);
        }
    }
}
