<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class RefundCreate implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('shapin_stripe');

        $rootNode
            ->children()
                ->scalarNode('charge')
                    ->isRequired()
                    ->info('The identifier of the charge to refund.')
                ->end()
                ->integerNode('amount')
                    ->info('A positive integer in cents representing how much of this charge to refund. Can refund only up to the remaining, unrefunded amount of the charge.')
                ->end()
                ->arrayNode('metadata')
                    ->scalarPrototype()->end()
                    ->info('A set of key-value pairs that you can attach to a Refund object. This can be useful for storing additional information about the refund in a structured format. You can unset individual keys if you POST an empty value for that key. You can clear all keys if you POST an empty value for metadata')
                ->end()
                ->enumNode('reason')
                    ->info('String indicating the reason for the refund. If set, possible values are duplicate, fraudulent, and requested_by_customer. If you believe the charge to be fraudulent, specifying fraudulent as the reason will add the associated card and email to your blocklists, and will also help us improve our fraud detection algorithms.')
                    ->values(['duplicate', 'fraudulent', 'requested_by_customer'])
                ->end()
                ->booleanNode('refund_application_fee')
                    ->info('Boolean indicating whether the application fee should be refunded when refunding this charge. If a full charge refund is given, the full application fee will be refunded. Otherwise, the application fee will be refunded in an amount proportional to the amount of the charge refunded. An application fee can be refunded only by the application that created the charge.')
                    ->defaultValue(false)
                ->end()
                ->booleanNode('reverse_transfer')
                    ->info('Boolean indicating whether the transfer should be reversed when refunding this charge. The transfer will be reversed proportionally to the amount being refunded (either the entire or partial amount). A transfer can be reversed only by the application that created the charge.')
                    ->defaultValue(false)
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
