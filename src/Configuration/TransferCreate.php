<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class TransferCreate implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('shapin_stripe');

        $rootNode
            ->children()
                ->integerNode('amount')
                    ->isRequired()
                    ->info('A positive integer in cents representing how much to transfer.')
                ->end()
                ->scalarNode('currency')
                    ->isRequired()
                    ->info('3-letter ISO code for currency.')
                ->end()
                ->scalarNode('destination')
                    ->isRequired()
                    ->info('The ID of a connected Stripe account. See the Connect documentation for details.')
                ->end()
                ->scalarNode('description')
                    ->info('An arbitrary string attached to the object. Often useful for displaying to users. This will be unset if you POST an empty value.')
                ->end()
                ->arrayNode('metadata')
                    ->scalarPrototype()->end()
                    ->info('Set of key-value pairs that you can attach to an object. This can be useful for storing additional information about the object in a structured format. Individual keys can be unset by posting an empty value to them. All keys can be unset by posting an empty value to metadata.')
                ->end()
                ->scalarNode('source_transaction')
                    ->info('You can use this parameter to transfer funds from a charge before they are added to your available balance. A pending balance will transfer immediately but the funds will not become available until the original charge becomes available. See the Connect documentation for details.')
                ->end()
                ->scalarNode('transfer_group')
                    ->info('A string that identifies this transaction as part of a group. See the Connect documentation for details.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
