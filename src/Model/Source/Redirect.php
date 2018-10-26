<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Source;

use Shapin\Stripe\Model\CreatableFromArray;

final class Redirect implements CreatableFromArray
{
    /**
     * @var string
     */
    private $failureReason;

    /**
     * @var string
     */
    private $returnUrl;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $url;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->failureReason = $data['failure_reason'];
        $model->returnUrl = $data['return_url'];
        $model->status = $data['status'];
        $model->url = $data['url'];

        return $model;
    }

    public function getFailureReason(): string
    {
        return $this->failureReason;
    }

    public function getReturnUrl(): string
    {
        return $this->returnUrl;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
