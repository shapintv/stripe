<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Account;

use Shapin\Stripe\Model\CreatableFromArray;

final class Settings implements CreatableFromArray
{
    /**
     * @var array
     */
    private $branding;

    /**
     * @var array
     */
    private $cardPayments;

    /**
     * @var array
     */
    private $dashboard;

    /**
     * @var array
     */
    private $payments;

    /**
     * @var array
     */
    private $payouts;

    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        $model = new self();
        $model->branding = $data['branding'];
        $model->cardPayments = $data['card_payments'];
        $model->dashboard = $data['dashboard'];
        $model->payments = $data['payments'];
        $model->payouts = $data['payouts'] ?? [];

        return $model;
    }

    public function getBranding(): array
    {
        return $this->branding;
    }

    public function getCardPayments(): array
    {
        return $this->cardPayments;
    }

    public function getDashboard(): array
    {
        return $this->dashboard;
    }

    public function getPayments(): array
    {
        return $this->payments;
    }

    public function getPayouts(): array
    {
        return $this->payouts;
    }
}
