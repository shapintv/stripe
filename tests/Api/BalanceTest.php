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
use Shapin\Stripe\Api\Balance;
use Shapin\Stripe\Hydrator\NoopHydrator;
use Shapin\Stripe\RequestBuilder;

final class BalanceTest extends ApiTestCase
{
    /**
     * @dataProvider balanceProvider
     */
    public function testGetBalanceTransactions($params, $expectedUrl)
    {
        $balance = $this->getMockedApi(Balance::class, new Request('GET', $expectedUrl));
        $this->assertResponseIsValid($balance->getBalanceTransactions($params));
    }

    public function balanceProvider()
    {
        yield [[], '/v1/balance/history'];
        yield [['limit' => 50], '/v1/balance/history?limit=50'];
    }
}
