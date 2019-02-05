<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Customer;

use Shapin\Stripe\Model\CreatableFromArray;

final class InvoiceSettings implements CreatableFromArray
{
    /**
     * @var array
     */
    private $customFields;

    /**
     * @var ?string
     */
    private $footer;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $customFields = [];
        if (isset($data['custom_fields'])) {
            foreach ($data['custom_fields'] as $customField) {
                $customFields[] = new CustomField($customField['name'], $customField['value']);
            }
        }

        $model = new self();
        $model->customFields = $customFields;
        $model->footer = $data['footer'];

        return $model;
    }

    public function getCustomFields(): array
    {
        return $this->customFields;
    }

    public function getFooter(): ?string
    {
        return $this->footer;
    }
}
