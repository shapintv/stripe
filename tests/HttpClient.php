<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Tests;

use GuzzleHttp\Psr7\Response;
use Http\Client\HttpClient as BaseHttpClient;
use Psr\Http\Message\RequestInterface;

final class HttpClient implements BaseHttpClient
{
    private $httpClient;

    public function __construct(BaseHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }


    /**
     * Return the content of a file on disk if it exists.
     * Otherwise call the embedded Httpclient.
     */
    public function sendRequest(RequestInterface $request)
    {
        $requestTarget = $request->getRequestTarget();
        $requestTarget = str_replace('/v1', '', $requestTarget);
        $requestTarget = str_replace('?', '+', $requestTarget);

        $file = __DIR__. "/fixtures/$requestTarget.json";

        if (file_exists($file)) {
            return new Response(200, [], file_get_contents($file));
        }

        return $this->httpClient->sendRequest($request);
    }
}
