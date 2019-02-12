<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class CustomerUpdate implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('shapin_stripe_customer_update');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->integerNode('account_balance')
                    ->info('An integer amount in cents that represents the account balance for your customer. Account balances only affect invoices. A negative amount represents a credit that decreases the amount due on an invoice; a positive amount increases the amount due on an invoice.')
                ->end()
                ->scalarNode('coupon')
                    ->info('If you provide a coupon code, the customer will have a discount applied on all recurring charges. Charges you create through the API will not have the discount. This will be unset if you POST an empty value.')
                ->end()
                ->scalarNode('default_source')
                    ->info('ID of the default payment source for the customer.')
                ->end()
                ->scalarNode('description')
                    ->info('An arbitrary string that you can attach to a customer object. It is displayed alongside the customer in the dashboard. This will be unset if you POST an empty value.')
                ->end()
                ->scalarNode('email')
                    ->info('Customer’s email address. It’s displayed alongside the customer in your dashboard and can be useful for searching and tracking. This may be up to 512 characters. This will be unset if you POST an empty value.')
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
                            ->info('Default footer to be displayed on invoices for this customer. This will be unset if you POST an empty value.')
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
                    ->info('A Token’s or a Source’s ID, as returned by Elements. Passing source will create a new source object, make it the new customer default source, and delete the old customer default if one exists. If you want to add additional sources instead of replacing the existing default, use the card creation API. Whenever you attach a card to a customer, Stripe will automatically validate the card.')
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
