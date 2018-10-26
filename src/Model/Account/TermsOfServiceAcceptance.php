<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Account;

use Shapin\Stripe\Model\CreatableFromArray;

final class TermsOfServiceAcceptance implements CreatableFromArray
{
    /**
     * @var \DateTimeImmutable
     */
    private $date;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var string
     */
    private $userAgent;

    public static function createFromArray(array $data)
    {
        $model = new self();
        $model->date = isset($data['date']) ? new \DateTimeImmutable('@'.$data['date']) : null;
        $model->ip = $data['ip'];
        $model->userAgent = $data['user_agent'];

        return $model;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }
}
