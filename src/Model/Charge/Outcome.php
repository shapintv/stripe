<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Charge;

use Shapin\Stripe\Model\CreatableFromArray;
use Money\Currency;
use Money\Money;

final class Outcome implements CreatableFromArray
{
    /**
     * @var string
     */
    private $networkStatus;

    /**
     * @var string
     */
    private $reason;

    /**
     * @var string
     */
    private $riskLevel;

    /**
     * @var int
     */
    private $riskScore;

    /**
     * @var string
     */
    private $rule;

    /**
     * @var string
     */
    private $sellerMessage;

    /**
     * @var string
     */
    private $type;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->networkStatus = $data['network_status'];
        $model->reason = $data['reason'];
        $model->riskLevel = $data['risk_level'] ?? null;
        $model->riskScore = $data['risk_score'] ? (int) $data['risk_score'] : null;
        $model->rule = $data['rule'] ?? null;
        $model->sellerMessage = $data['seller_message'];
        $model->type = $data['type'];

        return $model;
    }

    public function getNetworkStatus(): string
    {
        return $this->networkStatus;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function getRiskLevel(): ?string
    {
        return $this->riskLevel;
    }

    public function getRiskScore(): ?int
    {
        return $this->riskScore;
    }

    public function getRule(): ?string
    {
        return $this->rule;
    }

    public function getSellerMessage(): string
    {
        return $this->sellerMessage;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
