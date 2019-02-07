<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Exception\Domain as DomainExceptions;
use Shapin\Stripe\Exception\DomainException;
use Http\Client\HttpClient;
use Shapin\Stripe\Hydrator\Hydrator;
use Shapin\Stripe\RequestBuilder;
use Psr\Http\Message\ResponseInterface;

abstract class HttpApi
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * @var RequestBuilder
     */
    protected $requestBuilder;

    public function __construct(HttpClient $httpClient, Hydrator $hydrator, RequestBuilder $requestBuilder)
    {
        $this->httpClient = $httpClient;
        $this->hydrator = $hydrator;
        $this->requestBuilder = $requestBuilder;
    }

    /**
     * Send a GET request with query parameters.
     */
    protected function httpGet(string $path, array $params = [], array $requestHeaders = []): ResponseInterface
    {
        if (\count($params) > 0) {
            $path .= '?'.http_build_query($params);
        }

        return $this->httpClient->sendRequest(
            $this->requestBuilder->create('GET', $path, $requestHeaders)
        );
    }

    /**
     * Send a POST request with JSON-encoded parameters.
     */
    protected function httpPost(string $path, array $params = [], array $requestHeaders = []): ResponseInterface
    {
        return $this->httpPostRaw($path, $this->createJsonBody($params), $requestHeaders);
    }

    /**
     * Send a POST request with raw data.
     */
    protected function httpPostRaw(string $path, $body, array $requestHeaders = []): ResponseInterface
    {
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create('POST', $path, $requestHeaders, $body)
        );
    }

    /**
     * Send a PUT request with JSON-encoded parameters.
     */
    protected function httpPut(string $path, array $params = [], array $requestHeaders = []): ResponseInterface
    {
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create('PUT', $path, $requestHeaders, $this->createJsonBody($params))
        );
    }

    /**
     * Send a DELETE request with JSON-encoded parameters.
     */
    protected function httpDelete(string $path, array $params = [], array $requestHeaders = []): ResponseInterface
    {
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create('DELETE', $path, $requestHeaders, $this->createJsonBody($params))
        );
    }

    /**
     * Create a JSON encoded version of an array of parameters.
     */
    private function createJsonBody(array $params): ?string
    {
        if (0 === \count($params)) {
            return null;
        }

        return json_encode($params, \JSON_FORCE_OBJECT);
    }

    /**
     * Handle HTTP errors.
     *
     * Call is controlled by the specific API methods.
     *
     * @throws DomainException
     */
    protected function handleErrors(ResponseInterface $response)
    {
        switch ($response->getStatusCode()) {
            case 400:
                throw new DomainExceptions\BadRequestException($response);
            case 404:
                throw new DomainExceptions\NotFoundException();
            default:
                throw new DomainExceptions\UnknownErrorException($response);
        }
    }
}
