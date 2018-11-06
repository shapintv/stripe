<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class ChargeList implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('shapin_stripe');

        $rootNode
            ->children()
                ->arrayNode('created')
                    ->children()
                        ->integerNode('gt')
                            ->info('Return results where the created field is greater than this value.')
                        ->end()
                        ->integerNode('gte')
                            ->info('Return results where the created field is greater than or equal to this value.')
                        ->end()
                        ->integerNode('lt')
                            ->info('Return results where the created field is less than this value.')
                        ->end()
                        ->integerNode('lte')
                            ->info('Return results where the created field is less than or equal to this value.')
                        ->end()
                    ->end()
                    ->info('A filter on the list based on the object created field. The value can be a string with an integer Unix timestamp, or it can be a dictionary with the following options:')
                ->end()
                ->scalarNode('customer')
                    ->info('Only return charges for the customer specified by this customer ID.')
                ->end()
                ->scalarNode('ending_before')
                    ->info('A cursor for use in pagination. ending_before is an object ID that defines your place in the list. For instance, if you make a list request and receive 100 objects, starting with obj_bar, your subsequent call can include ending_before=obj_bar in order to fetch the previous page of the list.')
                ->end()
                ->integerNode('limit')
                    ->min(0)->max(100)
                    ->info('A limit on the number of objects to be returned. Limit can range between 1 and 100, and the default is 10.')
                ->end()
                ->arrayNode('source')
                    ->children()
                        ->enumNode('object')
                            ->values(['all', 'alipay_account', 'bank_account', 'bitcoin_receiver', 'card'])
                            ->info('Return charges that match this source type string. Available options are all, alipay_account, bank_account, bitcoin_receiver, or card.')
                        ->end()
                    ->end()
                    ->info('A filter on the list, based on the source of the charge. The value can be a dictionary with the following options:')
                ->end()
                ->scalarNode('starting_after')
                    ->info('A cursor for use in pagination. starting_after is an object ID that defines your place in the list. For instance, if you make a list request and receive 100 objects, ending with obj_foo, your subsequent call can include starting_after=obj_foo in order to fetch the next page of the list.')
                ->end()
                ->scalarNode('transfer_group')
                    ->info('Only return charges for this transfer group.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
