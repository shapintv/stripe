<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe;

use FAPI\Stripe\Api;
use FAPI\Stripe\Hydrator\ModelHydrator;
use FAPI\Stripe\Hydrator\Hydrator;
use Http\Client\HttpClient;

final class StripeClient
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var Hydrator
     */
    private $hydrator;

    /**
     * @var RequestBuilder
     */
    private $requestBuilder;

    /**
     * The constructor accepts already configured HTTP clients.
     * Use the configure method to pass a configuration to the Client and create an HTTP Client.
     */
    public function __construct(
        HttpClient $httpClient,
        Hydrator $hydrator = null,
        RequestBuilder $requestBuilder = null
    ) {
        $this->httpClient = $httpClient;
        $this->hydrator = $hydrator ?: new ModelHydrator();
        $this->requestBuilder = $requestBuilder ?: new RequestBuilder();
    }

    public static function configure(
        HttpClientConfigurator $httpClientConfigurator,
        Hydrator $hydrator = null,
        RequestBuilder $requestBuilder = null
    ): self {
        $httpClient = $httpClientConfigurator->createConfiguredClient();

        return new self($httpClient, $hydrator, $requestBuilder);
    }

    public static function create(string $apiKey): self
    {
        $httpClientConfigurator = (new HttpClientConfigurator())->setApiKey($apiKey);

        return self::configure($httpClientConfigurator);
    }

    public function balances(): Api\Balance
    {
        return new Api\Balance($this->httpClient, $this->hydrator, $this->requestBuilder);
    }
}
