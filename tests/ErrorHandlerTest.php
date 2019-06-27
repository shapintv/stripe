<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests;

use PHPUnit\Framework\TestCase;
use Shapin\Stripe\ErrorHandler;
use Shapin\Stripe\Exception\Domain as DomainExceptions;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class ErrorHandlerTest extends TestCase
{
    /**
     * @dataProvider statusCodeProvider
     */
    public function testStatusCode(int $statusCode, string $expectedException)
    {
        $this->expectException($expectedException);

        $response = $this->prophesize(ResponseInterface::class);
        $response->getContent(false)->willReturn(json_encode([
            'error' => [
                'message' => 'Just a test message',
            ],
        ]));
        $response->getStatusCode()->willReturn($statusCode);

        (new ErrorHandler())->handle($response->reveal());
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

        $response = $this->prophesize(ResponseInterface::class);
        $response->getContent(false)->willReturn(json_encode([
            'error' => [
                'code' => $errorCode,
                'message' => 'Just a test message',
            ],
        ]));
        $response->getStatusCode()->willReturn(400);

        (new ErrorHandler())->handle($response->reveal());
    }

    public function errorCodeProvider()
    {
        foreach (ErrorHandler::$errorCodes as $key => $value) {
            yield [$key, $value];
        }
    }
}
