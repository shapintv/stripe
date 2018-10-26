<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Stripe\Tests\Api\Card;

use FAPI\Stripe\Model\Card\Card;
use FAPI\Stripe\Model\Card\CardCollection;
use FAPI\Stripe\Tests\FunctionalTests\TestCase;;

final class AllTest extends TestCase
{
    private $cardApi;

    public function setUp()
    {
        $this->cardApi = $this->getStripeClient()->cards();
    }

    public function testGetCard()
    {
        $cardCollection = $this->cardApi->all('cus_DqnsnSXuILi5XU');

        $this->assertInstanceOf(CardCollection::class, $cardCollection);
        $this->assertCount(1, $cardCollection);
        $this->assertFalse($cardCollection->hasMore());

        foreach ($cardCollection as $card) {
            $this->assertInstanceOf(Card::class, $card);
        }
    }
}
