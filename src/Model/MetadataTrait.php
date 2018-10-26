<?php

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Model;

trait MetadataTrait
{
    /**
     * @var MetadataCollection
     */
    protected $metadata;

    public function getMetadata(): MetadataCollection
    {
        return $this->metadata;
    }
}
