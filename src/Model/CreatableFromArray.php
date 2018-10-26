<?php

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model;

interface CreatableFromArray
{
    /**
     * Create an API response object from the HTTP response from the API server.
     */
    public static function createFromArray(array $data);
}
