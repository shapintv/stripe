<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Source;

use Shapin\Stripe\Model\CreatableFromArray;

final class AchCreditTransfer implements CreatableFromArray
{
    /**
     * @var string
     */
    private $accountNumber;

    /**
     * @var string
     */
    private $routingNumber;

    /**
     * @var string
     */
    private $fingerprint;

    /**
     * @var string
     */
    private $bankName;

    /**
     * @var string
     */
    private $swiftCode;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->accountNumber = $data['account_number'];
        $model->routingNumber = $data['routing_number'];
        $model->fingerprint = $data['fingerprint'];
        $model->bankName = $data['bank_name'];
        $model->swiftCode = $data['swift_code'];

        return $model;
    }

    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    public function getRoutingNumber(): string
    {
        return $this->routingNumber;
    }

    public function getFingerprint(): string
    {
        return $this->fingerprint;
    }

    public function getBankName(): string
    {
        return $this->bankName;
    }

    public function getSwiftCode(): string
    {
        return $this->swiftCode;
    }
}
