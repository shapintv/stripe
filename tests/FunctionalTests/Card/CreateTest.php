<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Card;

use Shapin\Stripe\Model\Card\Card;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class CreateTest extends TestCase
{
    private $cardApi;

    public function setUp(): void
    {
        $this->cardApi = $this->getStripeClient()->cards();
    }

    public function testCreateCard()
    {
        $card = $this->cardApi->create('cus_an_id', [
            'source' => 'tok_visa',
        ]);

        $this->assertInstanceOf(Card::class, $card);
    }
}
