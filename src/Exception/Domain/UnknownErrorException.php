<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Exception\Domain;

use Shapin\Stripe\Exception\DomainException;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class UnknownErrorException extends \Exception implements DomainException
{
    protected $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $content = json_decode($response->getContent(false), true);

        parent::__construct($content['error']['message']);
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
