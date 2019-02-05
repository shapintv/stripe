<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

use Shapin\Stripe\Model\LivemodeTrait;

class Event
{
    use LivemodeTrait;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $apiVersion;

    /**
     * @var \DateTimeImmutable
     */
    protected $createdAt;

    /**
     * @var integer
     */
    protected $pendingWebhooks;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var string
     */
    protected $type;

    public function getId(): string
    {
        return $this->id;
    }

    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getPendingWebhooks(): int
    {
        return $this->pendingWebhooks;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
