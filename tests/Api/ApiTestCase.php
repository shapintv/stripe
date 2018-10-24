<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Tests\Api;

use FAPI\Stripe\HttpClientConfigurator;
use FAPI\Stripe\StripeClient;
use GuzzleHttp\Psr7\Request;
use Http\Client\Exception\NetworkException;
use PHPUnit\Framework\TestCase;

abstract class ApiTestCase extends TestCase
{
    const API_KEY = 'sk_test_123';
    const API_ENDPOINT = 'http://127.0.0.1:12111';

    public function getStripeClient()
    {
        $httpClientConfigurator = new HttpClientConfigurator();
        $httpClientConfigurator
            ->setApiKey(self::API_KEY)
            ->setEndpoint(self::API_ENDPOINT)
        ;

        $httpClient = $httpClientConfigurator->createConfiguredClient();

        try {
            $httpClient->sendRequest(new Request('GET', '/'));
        } catch (NetworkException $e) {
            $this->fail('Looks like Stripe MOCK API is not running: '.$e->getMessage());
        }

        return new StripeClient($httpClient, new TestModelHydrator());
    }
}
