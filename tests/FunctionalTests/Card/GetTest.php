<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Api\Card;

use Shapin\Stripe\Model\Card\Card;
use Shapin\Stripe\Model\MetadataCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;;

final class GetTest extends TestCase
{
    private $cardApi;

    public function setUp()
    {
        $this->cardApi = $this->getStripeClient()->cards();
    }

    public function testGet()
    {
        $card = $this->cardApi->get('cus_DqnsnSXuILi5XU', 'card_1DP6GHIpafQncvOMir3nvI0p');

        $this->assertInstanceOf(Card::class, $card);

        $this->assertSame('card_1DP6GHIpafQncvOMir3nvI0p', $card->getId());
        $this->assertNull($card->getAddress()->getCity());
        $this->assertNull($card->getAddress()->getCountry());
        $this->assertNull($card->getAddress()->getFirstLine());
        $this->assertNull($card->getAddress()->getFirstLineCheck());
        $this->assertNull($card->getAddress()->getSecondLine());
        $this->assertNull($card->getAddress()->getState());
        $this->assertNull($card->getAddress()->getZip());
        $this->assertNull($card->getAddress()->getZipCheck());
        $this->assertNull($card->getAvailablePayoutMethods());
        $this->assertSame('Visa', $card->getBrand());
        $this->assertSame('US', $card->getCountry());
        $this->assertNull($card->getCurrency());
        $this->assertNull($card->getCustomer());
        $this->assertNull($card->getDefaultForCurrency());
        $this->assertNull($card->getDynamicLastFour());
        $this->assertSame(8, $card->getExpirationMonth());
        $this->assertSame(2019, $card->getExpirationYear());
        $this->assertSame('Syn8Oqv0YpUEeWLz', $card->getFingerprint());
        $this->assertSame('unknown', $card->getFunding());
        $this->assertSame('4242', $card->getLastFour());
        $this->assertInstanceOf(MetadataCollection::class, $card->getMetadata());
        $this->assertCount(0, $card->getMetadata());
        $this->assertSame('Jenny Rosen', $card->getName());
        $this->assertNull($card->getRecipient());
        $this->assertNull($card->getTokenizationMethod());
    }
}
