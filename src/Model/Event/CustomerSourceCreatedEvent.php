<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\Source\Source;

final class CustomerSourceCreatedEvent extends Event implements CreatableFromArray
{
    /**
     * @var string
     */
    private $source;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->apiVersion = $data['api_version'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->pendingWebhooks = (int) $data['pending_webhooks'];
        $model->request = isset($data['request']) ? Request::createFromArray($data['request']) : null;
        $model->type = $data['type'];

        $model->source = Source::createFromArray($data['data']['object']);

        return $model;
    }

    public function getSource(): Source
    {
        return $this->source;
    }
}
