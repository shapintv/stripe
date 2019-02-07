<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Invoice;

use Shapin\Stripe\Model\CreatableFromArray;

final class Period implements CreatableFromArray
{
    /**
     * @var \DateTimeImmutable
     */
    private $endAt;

    /**
     * @var \DateTimeImmutable
     */
    private $startAt;

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->endAt = new \DateTimeImmutable('@'.$data['end']);
        $model->startAt = new \DateTimeImmutable('@'.$data['start']);

        return $model;
    }

    public function getEndAt(): \DateTimeImmutable
    {
        return $this->endAt;
    }

    public function getStartAt(): \DateTimeImmutable
    {
        return $this->startAt;
    }
}
