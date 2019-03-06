<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Account;

use Shapin\Stripe\Model\CreatableFromArray;

final class Requirements implements CreatableFromArray
{
    /**
     * @var ?\DateTimeImmutable
     */
    private $currentDeadline;

    /**
     * @var array
     */
    private $currentlyDue;

    /**
     * @var ?string
     */
    private $disabledReason;

    /**
     * @var array
     */
    private $eventuallyDue;

    /**
     * @var array
     */
    private $pastDue;

    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        $model = new self();
        $model->currentDeadline = isset($data['current_deadline']) ? new \DateTimeImmutable('@'.$data['current_deadline']) : null;
        $model->currentlyDue = $data['currently_due'];
        $model->disabledReason = $data['disabled_reason'];
        $model->eventuallyDue = $data['eventually_due'];
        $model->pastDue = $data['past_due'];

        return $model;
    }

    public function getCurrentDeadline(): ?\DateTimeImmutable
    {
        return $this->currentDeadline;
    }

    public function getCurrentlyDue(): array
    {
        return $this->currentlyDue;
    }

    public function getDisabledReason(): ?string
    {
        return $this->disabledReason;
    }

    public function getEventuallyDue(): array
    {
        return $this->eventuallyDue;
    }

    public function getPastDue(): array
    {
        return $this->pastDue;
    }
}
