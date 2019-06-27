<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Shapin\Stripe\HttpClientConfigurator;
use Shapin\Stripe\StripeClient;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpClient\HttpClient;

abstract class TestCase extends BaseTestCase
{
    const API_KEY = 'sk_test_123';
    const API_ENDPOINT = 'http://127.0.0.1:12111';

    public function getStripeClient()
    {
        $httpClient = HttpClient::create([
            'base_uri' => 'http://127.0.0.1:12111/v1/',
            'auth_bearer' => self::API_KEY,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        try {
            $httpClient->request('GET', '')->getStatusCode();
        } catch (TransportException $e) {
            $this->fail('Looks like Stripe MOCK API is not running: '.$e->getMessage());
        }

        return new StripeClient($httpClient, new TestModelHydrator());
    }
}
