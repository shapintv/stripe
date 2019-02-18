<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests;

use PHPUnit\Framework\TestCase;
use Shapin\Stripe\HttpQueryBuilder;

final class HttpQueryBuilderTest extends TestCase
{
    public function buildData()
    {
        yield [[], ''];
        yield [['key' => true], 'key=true'];
        yield [['key' => 'value'], 'key=value'];
        yield [['key' => 'val%ue'], 'key=val%25ue'];
        yield [['key' => 'value', 'integer' => 34, 'bool' => true], 'key=value&integer=34&bool=true'];
        yield [['key' => ['subkey1' => 'value1', 'subkey2' => 'value2']], 'key[subkey1]=value1&key[subkey2]=value2'];
        yield [['key' => ['subkey1' => ['subsubkey1' => 'subsubvalue1', 'subsubkey2' => 'subsubvalue2'], 'subkey2' => 'value2']], 'key[subkey1][subsubkey1]=subsubvalue1&key[subkey1][subsubkey2]=subsubvalue2&key[subkey2]=value2'];
    }

    /**
     * @dataProvider buildData
     */
    public function testBuild(array $params, string $expectedOutput)
    {
        $this->assertSame($expectedOutput, (new HttpQueryBuilder())->build($params));
    }
}
