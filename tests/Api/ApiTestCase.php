<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Api;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Http\Client\HttpClient;
use PHPUnit\Framework\TestCase;
use Shapin\Stripe\Hydrator\NoopHydrator;
use Shapin\Stripe\RequestBuilder;

class ApiTestCase extends TestCase
{
    public function getMockedApi(string $classUnderTest, Request $request)
    {
        $httpClient = $this->prophesize(HttpClient::class);
        $httpClient->sendRequest($request)->shouldBeCalledTimes(1)->willReturn(new Response(200));

        return new $classUnderTest($httpClient->reveal(), new NoopHydrator(), new RequestBuilder());
    }

    protected function assertResponseIsValid(Response $response)
    {
        $this->assertEquals(new Response(200), $response);
    }
}
