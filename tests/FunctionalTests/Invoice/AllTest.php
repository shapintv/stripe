<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\FunctionalTests\Invoice;

use Shapin\Stripe\Model\Invoice\Invoice;
use Shapin\Stripe\Model\Invoice\InvoiceCollection;
use Shapin\Stripe\Tests\FunctionalTests\TestCase;

final class AllTest extends TestCase
{
    private $invoiceApi;

    public function setUp(): void
    {
        $this->invoiceApi = $this->getStripeClient()->invoices();
    }

    public function testGetInvoice()
    {
        $invoiceCollection = $this->invoiceApi->all();

        $this->assertInstanceOf(InvoiceCollection::class, $invoiceCollection);
        $this->assertCount(1, $invoiceCollection);
        $this->assertFalse($invoiceCollection->hasMore());

        foreach ($invoiceCollection as $invoice) {
            $this->assertInstanceOf(Invoice::class, $invoice);
        }
    }
}
