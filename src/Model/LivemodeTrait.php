<?php

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model;

trait LivemodeTrait
{
    /**
     * @var bool
     */
    protected $live;

    public function isLive(): bool
    {
        return $this->live;
    }
}
