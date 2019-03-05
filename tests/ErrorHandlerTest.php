<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Shapin\Stripe\ErrorHandler;
use Shapin\Stripe\Exception\Domain as DomainExceptions;

final class ErrorHandlerTest extends TestCase
{
    /**
     * @dataProvider statusCodeProvider
     */
    public function testStatusCode(int $statusCode, string $expectedException)
    {
        $this->expectException($expectedException);

        (new ErrorHandler())->handle(new Response($statusCode, [], json_encode([
            'error' => [
                'message' => 'Just a test message',
            ],
        ])));
    }

    public function statusCodeProvider()
    {
        yield [400, DomainExceptions\BadRequestException::class];
        yield [404, DomainExceptions\NotFoundException::class];
        yield [500, DomainExceptions\UnknownErrorException::class];
    }

    /**
     * @dataProvider errorCodeProvider
     */
    public function testErrorCode(string $errorCode, string $expectedException)
    {
        $this->expectException($expectedException);

        (new ErrorHandler())->handle(new Response(400, [], json_encode([
            'error' => [
                'code' => $errorCode,
                'message' => 'Just a test message',
            ],
        ])));
    }

    public function errorCodeProvider()
    {
        foreach (ErrorHandler::$errorCodes as $key => $value) {
            yield [$key, $value];
        }
    }
}
