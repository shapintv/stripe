<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

use Shapin\Stripe\Model\CreatableFromArray;

final class Request implements CreatableFromArray
{
    /**
     * @var ?string
     */
    private $id;

    /**
     * @var ?string
     */
    private $idempotencyKey;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->idempotencyKey = $data['idempotency_key'];

        return $model;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getIdempotencyKey(): ?string
    {
        return $this->idempotencyKey;
    }
}
