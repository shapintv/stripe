<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\ErrorHandler;
use Shapin\Stripe\HttpQueryBuilder;
use Shapin\Stripe\Hydrator\Hydrator;
use Shapin\Stripe\RequestBuilder;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

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
     * @var HttpQueryBuilder
     */
    protected $httpQueryBuilder;

    /**
     * @var ErrorHandler
     */
    protected $errorHandler;

    public function __construct(HttpClientInterface $httpClient, Hydrator $hydrator, HttpQueryBuilder $httpQueryBuilder = null, ErrorHandler $errorHandler = null)
    {
        $this->httpClient = $httpClient;
        $this->hydrator = $hydrator;
        $this->httpQueryBuilder = $httpQueryBuilder ?: new HttpQueryBuilder();
        $this->errorHandler = $errorHandler ?: new ErrorHandler();
    }

    /**
     * Send a GET request with query parameters.
     */
    protected function httpGet(string $path, array $params = [], array $requestHeaders = []): ResponseInterface
    {
        $response = $this->httpClient->request('GET', $path, [
            'query' => $params,
            'headers' => $requestHeaders,
        ]);

        if (200 !== $response->getStatusCode()) {
            $this->errorHandler->handle($response);
        }

        return $response;
    }

    /**
     * Send a POST request with JSON-encoded parameters.
     */
    protected function httpPost(string $path, array $params = [], array $requestHeaders = []): ResponseInterface
    {
        if (empty($requestHeaders)) {
            $requestHeaders = ['Content-Type' => 'application/x-www-form-urlencoded'];
        }

        $response = $this->httpPostRaw($path, $this->httpQueryBuilder->build($params), $requestHeaders);

        if (200 !== $response->getStatusCode()) {
            $this->errorHandler->handle($response);
        }

        return $response;
    }

    /**
     * Send a PUT request with JSON-encoded parameters.
     */
    protected function httpPut(string $path, array $params = [], array $requestHeaders = []): ResponseInterface
    {
        $response = $this->httpClient->request('PUT', $path, [
            'body' => $params,
            'headers' => $requestHeaders,
        ]);

        if (200 !== $response->getStatusCode()) {
            $this->errorHandler->handle($response);
        }

        return $response;
    }

    /**
     * Send a DELETE request with JSON-encoded parameters.
     */
    protected function httpDelete(string $path, array $params = [], array $requestHeaders = []): ResponseInterface
    {
        $response = $this->httpClient->request('DELETE', $path, [
            'body' => $params,
            'headers' => $requestHeaders,
        ]);

        if (200 !== $response->getStatusCode()) {
            $this->errorHandler->handle($response);
        }

        return $response;
    }

    /**
     * Send a POST request with raw data.
     */
    private function httpPostRaw(string $path, $body, array $requestHeaders = []): ResponseInterface
    {
        return $this->httpClient->request('POST', $path, [
            'body' => $body,
            'headers' => $requestHeaders,
        ]);
    }
}
