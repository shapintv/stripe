<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Shapin\Stripe\Model\Invoice\Invoice;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class InvoiceList implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('shapin_stripe');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->enumNode('billing')
                    ->values([Invoice::BILLING_CHARGE_AUTOMATICALLY, Invoice::BILLING_SEND_INVOICE])
                    ->info('The billing mode of the invoice to retrieve. Either charge_automatically or send_invoice.')
                ->end()
                ->scalarNode('customer')
                    ->info('Only return invoices for the customer specified by this customer ID.')
                ->end()
                ->arrayNode('date')
                    ->children()
                        ->integerNode('gt')
                            ->info('Return results where the date field is greater than this value.')
                        ->end()
                        ->integerNode('gte')
                            ->info('Return results where the date field is greater than or equal to this value.')
                        ->end()
                        ->integerNode('lt')
                            ->info('Return results where the date field is less than this value.')
                        ->end()
                        ->integerNode('lte')
                            ->info('Return results where the date field is less than or equal to this value.')
                        ->end()
                    ->end()
                    ->info('A filter on the list based on the object date field. The value can be a string with an integer Unix timestamp, or it can be a dictionary with the following options:')
                ->end()
                ->arrayNode('due_date')
                    ->children()
                        ->integerNode('gt')
                            ->info('Return results where the due_date field is greater than this value.')
                        ->end()
                        ->integerNode('gte')
                            ->info('Return results where the due_date field is greater than or equal to this value.')
                        ->end()
                        ->integerNode('lt')
                            ->info('Return results where the due_date field is less than this value.')
                        ->end()
                        ->integerNode('lte')
                            ->info('Return results where the due_date field is less than or equal to this value.')
                        ->end()
                    ->end()
                    ->info('A filter on the list based on the object due_date field. The value can be a string with an integer Unix timestamp, or it can be a dictionary with the following options:')
                ->end()
                ->scalarNode('ending_before')
                    ->info('A cursor for use in pagination. ending_before is an object ID that defines your place in the list. For instance, if you make a list request and receive 100 objects, starting with obj_bar, your subsequent call can include ending_before=obj_bar in order to fetch the previous page of the list.')
                ->end()
                ->integerNode('limit')
                    ->min(0)->max(100)
                    ->info('A limit on the number of objects to be returned. Limit can range between 1 and 100, and the default is 10.')
                ->end()
                ->scalarNode('starting_after')
                    ->info('A cursor for use in pagination. starting_after is an object ID that defines your place in the list. For instance, if you make a list request and receive 100 objects, ending with obj_foo, your subsequent call can include starting_after=obj_foo in order to fetch the next page of the list.')
                ->end()
                ->scalarNode('subscription')
                    ->info('Only return invoices for the subscription specified by this subscription ID.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
