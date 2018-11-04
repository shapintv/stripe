<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Source;

use Shapin\Stripe\Model\CreatableFromArray;

final class CodeVerification implements CreatableFromArray
{
    /**
     * @var int
     */
    private $attemptsRemaining;

    /**
     * @var string
     */
    private $status;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->attemptsRemaining = (int) $data['attempts_remaining'];
        $model->status = $data['status'];

        return $model;
    }

    public function getAttemptsRemaining(): int
    {
        return $this->attemptsRemaining;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
