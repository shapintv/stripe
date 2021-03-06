<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Customer;

use Shapin\Stripe\Model\CreatableFromArray;

final class CustomerDeleted implements CreatableFromArray
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var bool
     */
    private $deleted;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->deleted = (bool) $data['deleted'];

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function isDeleted(): bool
    {
        return $this->deleted;
    }
}
