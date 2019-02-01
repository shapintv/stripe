<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Shapin\Stripe\Model\Subscription\Subscription;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class SubscriptionUpdate implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('shapin_stripe');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->floatNode('application_fee_percent')
                    ->info('A non-negative decimal between 0 and 100, with at most two decimal places. This represents the percentage of the subscription invoice subtotal that will be transferred to the application owner’s Stripe account. The request must be made with an OAuth key in order to set an application fee percentage. For more information, see the application fees documentation.')
                ->end()
                ->enumNode('billing')
                    ->values([Subscription::BILLING_CHARGE_AUTOMATICALLY, Subscription::BILLING_SEND_INVOICE])
                    ->info('Either charge_automatically, or send_invoice. When charging automatically, Stripe will attempt to pay this subscription at the end of the cycle using the default source attached to the customer. When sending an invoice, Stripe will email your customer an invoice with payment instructions. Defaults to charge_automatically.')
                ->end()
                ->enumNode('billing_cycle_anchor')
                    ->values(['now', 'unchanged'])
                    ->info('Either now or unchanged. Setting the value to now resets the subscription’s billing cycle anchor to the current time. For more information, see the billing cycle documentation.')
                ->end()
                ->arrayNode('billing_thresholds')
                    ->children()
                        ->integerNode('amount_gte')
                            ->info('Monetary threshold that triggers the subscription to advance to a new billing period')
                        ->end()
                        ->booleanNode('reset_billing_cycle_anchor')
                            ->info('Indicates if the billing_cycle_anchor should be reset when a threshold is reached. If true, billing_cycle_anchor will be updated to the date/time the threshold was last reached; otherwise, the value will remain unchanged.')
                        ->end()
                    ->end()
                    ->info('Define thresholds at which an invoice will be sent, and the subscription advanced to a new billing period. Pass an empty string to remove previously-defined thresholds.')
                ->end()
                ->booleanNode('cancel_at_period_end')
                    ->info('Boolean indicating whether this subscription should cancel at the end of the current period.')
                ->end()
                ->scalarNode('customer')
                    ->info('The identifier of the customer to subscribe.')
                ->end()
                ->scalarNode('coupon')
                    ->info('The code of the coupon to apply to this subscription. A coupon applied to a subscription will only affect invoices created for that particular subscription. This will be unset if you POST an empty value.')
                ->end()
                ->integerNode('days_until_due')
                    ->info('Number of days a customer has to pay invoices generated by this subscription. Valid only for subscriptions where billing is set to send_invoice.')
                ->end()
                ->scalarNode('default_source')
                    ->info('ID of the default payment source for the subscription. It must belong to the customer associated with the subscription and be in a chargeable state. If not set, defaults to the customer’s default source.')
                ->end()
                ->arrayNode('items')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('id')
                                ->info('Subscription item to update.')
                            ->end()
                            ->arrayNode('billing_thresholds')
                                ->children()
                                    ->integerNode('usage_gte')
                                        ->isRequired()
                                        ->info('Usage threshold that triggers the subscription to advance to a new billing period')
                                    ->end()
                                ->end()
                                ->info('Define thresholds at which an invoice will be sent, and the subscription advanced to a new billing period')
                            ->end()
                            ->booleanNode('clear_usage')
                                ->info('Delete all usage for a given subscription item. Allowed only when deleted is set to true and the current plan’s usage_type is metered')
                            ->end()
                            ->booleanNode('deleted')
                                ->info('A flag that, if set to true, will delete the specified item.')
                            ->end()
                            ->arrayNode('metadata')
                                ->scalarPrototype()->end()
                                ->info('Set of key-value pairs that you can attach to an object. This can be useful for storing additional information about the object in a structured format.')
                            ->end()
                            ->scalarNode('plan')
                                ->info('Plan ID for this item, as a string.')
                            ->end()
                            ->integerNode('quantity')
                                ->info('Quantity for this item.')
                            ->end()
                        ->end()
                        ->validate()
                            ->ifTrue(function ($v) {
                                return isset($v['clear_usage']) && true === $v['clear_usage'] && (!isset($v['deleted']) || false === $v['deleted']);
                            })
                            ->thenInvalid('Cannot clear usage of a non deleted item.')
                        ->end()
                    ->end()
                    ->info('Define thresholds at which an invoice will be sent, and the subscription advanced to a new billing period. Pass an empty string to remove previously-defined thresholds.')
                ->end()
                ->arrayNode('metadata')
                    ->scalarPrototype()->end()
                    ->info('Set of key-value pairs that you can attach to an object. This can be useful for storing additional information about the object in a structured format. Individual keys can be unset by posting an empty value to them. All keys can be unset by posting an empty value to metadata.')
                ->end()
                ->booleanNode('prorate')
                    ->info('Boolean (defaults to true) telling us whether to credit for unused time when the billing cycle changes (e.g. when switching plans, resetting billing_cycle_anchor=now, or starting a trial), or if an item’s quantity changes. If false, the anchor period will be free (similar to a trial) and no proration adjustments will be created.')
                ->end()
                ->floatNode('tax_percent')
                    ->info('A non-negative decimal (with at most four decimal places) between 0 and 100. This represents the percentage of the subscription invoice subtotal that will be calculated and added as tax to the final amount in each billing period. For example, a plan which charges $10/month with a tax_percent of 20.0 will charge $12 per invoice. To unset a previously-set value, pass an empty string.')
                ->end()
                ->integerNode('trial_end')
                    ->info('Unix timestamp representing the end of the trial period the customer will get before being charged for the first time. This will always overwrite any trials that might apply via a subscribed plan. If set, trial_end will override the default trial period of the plan the customer is being subscribed to. The special value now can be provided to end the customer’s trial immediately.')
                ->end()
                ->booleanNode('trial_from_plan')
                    ->info('Indicates if a plan’s trial_period_days should be applied to the subscription. Setting trial_end per subscription is preferred, and this defaults to false. Setting this flag to true together with trial_end is not allowed.')
                ->end()
            ->end()
        ;

        $rootNode
            ->validate()
                ->ifTrue(function ($v) {
                    return isset($v['billing']) && Subscription::BILLING_SEND_INVOICE !== $v['billing'] && isset($v['days_until_due']);
                })
                ->thenInvalid('You can only set "days_until_due" for "send_invoice" billing type.')
            ->end()
        ;

        return $treeBuilder;
    }
}
