<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe;

use Shapin\Stripe\Hydrator\Hydrator;
use Shapin\Stripe\Hydrator\ModelHydrator;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class StripeClient
{
    private $httpClient;
    private $hydrator;

    /**
     * The constructor accepts already configured HTTP clients.
     * Use the configure method to pass a configuration to the Client and create an HTTP Client.
     */
    public function __construct(HttpClientInterface $stripeClient, Hydrator $hydrator = null)
    {
        $this->httpClient = $stripeClient;
        $this->hydrator = $hydrator ?: new ModelHydrator();
    }

    public function balances(): Api\Balance
    {
        return new Api\Balance($this->httpClient, $this->hydrator);
    }

    public function charges(): Api\Charge
    {
        return new Api\Charge($this->httpClient, $this->hydrator);
    }

    public function refunds(): Api\Refund
    {
        return new Api\Refund($this->httpClient, $this->hydrator);
    }

    public function cards(): Api\Card
    {
        return new Api\Card($this->httpClient, $this->hydrator);
    }

    public function bankAccounts(): Api\BankAccount
    {
        return new Api\BankAccount($this->httpClient, $this->hydrator);
    }

    public function accounts(): Api\Account
    {
        return new Api\Account($this->httpClient, $this->hydrator);
    }

    public function sources(): Api\Source
    {
        return new Api\Source($this->httpClient, $this->hydrator);
    }

    public function transfers(): Api\Transfer
    {
        return new Api\Transfer($this->httpClient, $this->hydrator);
    }

    public function products(): Api\Product
    {
        return new Api\Product($this->httpClient, $this->hydrator);
    }

    public function customers(): Api\Customer
    {
        return new Api\Customer($this->httpClient, $this->hydrator);
    }

    public function subscriptions(): Api\Subscription
    {
        return new Api\Subscription($this->httpClient, $this->hydrator);
    }

    public function plans(): Api\Plan
    {
        return new Api\Plan($this->httpClient, $this->hydrator);
    }

    public function invoices(): Api\Invoice
    {
        return new Api\Invoice($this->httpClient, $this->hydrator);
    }

    public function coupons(): Api\Coupon
    {
        return new Api\Coupon($this->httpClient, $this->hydrator);
    }

    public function paymentIntents(): Api\PaymentIntent
    {
        return new Api\PaymentIntent($this->httpClient, $this->hydrator);
    }

    public function taxRates(): Api\TaxRate
    {
        return new Api\TaxRate($this->httpClient, $this->hydrator);
    }

    public function setupIntents(): Api\SetupIntent
    {
        return new Api\SetupIntent($this->httpClient, $this->hydrator);
    }
}
