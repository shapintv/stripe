<?php

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model;

interface ContainsMetadata
{
    /**
     * Retrieve Metadata associated to current Model.
     */
    public function getMetadata(): MetadataCollection;
}
