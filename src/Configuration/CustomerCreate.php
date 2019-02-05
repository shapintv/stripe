<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class CustomerCreate implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('shapin_stripe_customer_create');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->integerNode('account_balance')
                    ->info('An integer amount in pence that represents the account balance for your customer. Account balances only affect invoices. A negative amount represents a credit that decreases the amount due on an invoice; a positive amount increases the amount due on an invoice.')
                ->end()
                ->scalarNode('coupon')
                    ->info('The code of the coupon to apply to this subscription. A coupon applied to a subscription will only affect invoices created for that particular subscription. This can be unset by updating the value to null and then saving.')
                ->end()
                ->scalarNode('default_source')
                    ->info('ID of the default payment source for the customer.')
                ->end()
                ->scalarNode('description')
                    ->info('An arbitrary string that you can attach to a customer object. It is displayed alongside the customer in the dashboard. This can be unset by updating the value to null and then saving.')
                ->end()
                ->scalarNode('email')
                    ->info('Customer’s email address. It’s displayed alongside the customer in your dashboard and can be useful for searching and tracking. This may be up to 512 characters. This can be unset by updating the value to null and then saving.')
                ->end()
                ->scalarNode('invoice_prefix')
                    ->info('The prefix for the customer used to generate unique invoice numbers. Must be 3–12 uppercase letters or numbers.')
                ->end()
                ->arrayNode('invoice_settings')
                    ->children()
                        ->arrayNode('custom_fields')
                            ->arrayPrototype()
                                ->children()
                                    ->scalarNode('name')
                                        ->isRequired()
                                        ->info('The name of the custom field. This may be up to 30 characters.')
                                    ->end()
                                    ->scalarNode('value')
                                        ->isRequired()
                                        ->info('The value of the custom field. This may be up to 30 characters.')
                                    ->end()
                                ->end()
                            ->end()
                            ->info('Default custom fields to be displayed on invoices for this customer.')
                        ->end()
                        ->scalarNode('footer')
                            ->info('Default footer to be displayed on invoices for this customer. This can be unset by updating the value to null and then saving.')
                        ->end()
                    ->end()
                    ->info('Default invoice settings for this customer.')
                ->end()
                ->arrayNode('metadata')
                    ->scalarPrototype()->end()
                    ->info('A set of key-value pairs that you can attach to a customer object. It can be useful for storing additional information about the customer in a structured format.')
                ->end()
                ->arrayNode('shipping')
                    ->children()
                        ->arrayNode('address')
                            ->isRequired()
                            ->children()
                                ->scalarNode('line1')
                                    ->isRequired()
                                    ->cannotBeEmpty()
                                ->end()
                                ->scalarNode('city')->end()
                                ->scalarNode('country')->end()
                                ->scalarNode('line2')->end()
                                ->scalarNode('postal_code')->end()
                                ->scalarNode('state')->end()
                            ->end()
                            ->info('Customer shipping address.')
                        ->end()
                        ->scalarNode('name')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->info('Customer name. This can be unset by updating the value to null and then saving.')
                        ->end()
                        ->scalarNode('phone')
                            ->info('Customer phone (including extension). This can be unset by updating the value to null and then saving.')
                        ->end()
                    ->end()
                    ->info('The customer’s shipping information. Appears on invoices emailed to this customer.')
                ->end()
                ->scalarNode('source')
                    ->info('The source can either be a Token or a Source, as returned by Elements, or a associative array containing a user’s credit card details (with the options shown below). You must provide a source if the customer does not already have a valid source attached, and you are subscribing the customer to be charged automatically for a plan that is not free. Passing source will create a new source object, make it the customer default source, and delete the old customer default if one exists. If you want to add an additional source, instead use the card creation API to add the card and then the customer update API to set it as the default. Whenever you attach a card to a customer, Stripe will automatically validate the card.')
                ->end()
                ->arrayNode('tax_info')
                    ->children()
                        ->scalarNode('tax_id')
                            ->isRequired(true)
                            ->info('The customer’s tax ID number. This can be unset by updating the value to null and then saving.')
                        ->end()
                        ->scalarNode('type')
                            ->isRequired(true)
                            ->info('The type of ID number. The only possible value is vat')
                        ->end()
                    ->end()
                    ->info('The customer’s tax information. Appears on invoices emailed to this customer.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
