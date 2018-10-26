<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Model\Account;

use FAPI\Stripe\Model\CreatableFromArray;

final class AccountVerification implements CreatableFromArray
{
    /**
     * @var string
     */
    private $disabledReason;

    /**
     * @var \DateTimeImmutable
     */
    private $dueBy;

    /**
     * @var array
     */
    private $fieldsNeeded;

    public static function createFromArray(array $data)
    {
        $model = new self();
        $model->disabledReason = $data['disabled_reason'];
        $model->dueBy = isset($data['due_by']) ? new \DateTimeImmutable('@'.$data['due_by']) : null;
        $model->fieldsNeeded = $data['fields_needed'];

        return $model;
    }

    public function getDisabledReason(): string
    {
        return $this->disabledReason;
    }

    public function getDueBy(): ?\DateTimeImmutable
    {
        return $this->dueBy;
    }

    public function getFieldsNeeded(): array
    {
        return $this->fieldsNeeded;
    }
}
