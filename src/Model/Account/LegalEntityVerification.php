<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Model\Account;

use FAPI\Stripe\Model\CreatableFromArray;

final class LegalEntityVerification implements CreatableFromArray
{
    /**
     * @var ?string
     */
    private $details;

    /**
     * @var ?string
     */
    private $detailsCode;

    /**
     * @var ?string
     */
    private $comment;

    /**
     * @var ?string
     */
    private $document;

    /**
     * @var ?string
     */
    private $documentBack;

    /**
     * @var string
     */
    private $status;

    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        $model = new self();
        $model->details = $data['details'];
        $model->detailsCode = $data['details_code'];
        $model->document = $data['document'];
        $model->documentBack = $data['document_back'];
        $model->status = $data['status'];

        return $model;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function getDetailsCode(): ?string
    {
        return $this->detailsCode;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function getDocumentBack(): ?string
    {
        return $this->documentBack;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
