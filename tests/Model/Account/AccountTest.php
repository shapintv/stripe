<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Model\Account;

use Shapin\Stripe\Model\Account\Account;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    public function testCreateFromArray()
    {
        $data = json_decode(file_get_contents(__DIR__.'/../../fixtures/accounts/acct_qsdDS87DJid8dkj.json'), true);

        $account = Account::createFromArray($data['object']);

        $this->assertInstanceOf(Account::class, $account);
    }
}
