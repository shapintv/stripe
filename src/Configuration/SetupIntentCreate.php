<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Shapin\Stripe\Model\SetupIntent\SetupIntent;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class SetupIntentCreate implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('shapin_stripe');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->booleanNode('confirm')
                    ->info('Set to true to attempt to confirm this SetupIntent immediately. This parameter defaults to false. If the payment method attached is a card, a return_url may be provided in case additional authentication is required.')
                ->end()
                ->scalarNode('customer')
                    ->info('ID of the Customer this SetupIntent belongs to, if one exists.')
                ->end()
                ->scalarNode('description')
                    ->info('An arbitrary string attached to the object. Often useful for displaying to users. This can be unset by updating the value to null and then saving.')
                ->end()
                ->arrayNode('metadata')
                    ->scalarPrototype()->end()
                    ->info('Set of key-value pairs that you can attach to an object. This can be useful for storing additional information about the object in a structured format.')
                ->end()
                ->scalarNode('on_behalf_of')
                    ->info('The Stripe account ID for which this SetupIntent is created.')
                ->end()
                ->scalarNode('payment_method')
                    ->info('ID of the payment method (a PaymentMethod, Card, BankAccount, or saved Source object) to attach to this SetupIntent.')
                ->end()
                ->scalarNode('return_url')
                    ->info('The URL to redirect your customer back to after they authenticate or cancel their payment on the payment method’s app or site. If you’d prefer to redirect to a mobile application, you can alternatively supply an application URI scheme. This parameter can only be used with confirm=true.')
                ->end()
                ->enumNode('usage')
                    ->values([SetupIntent::USAGE_ON_SESSION, SetupIntent::USAGE_OFF_SESSION])
                    ->info('Indicates how the payment method is intended to be used in the future.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
