<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Shapin\Stripe\Model\Coupon\Coupon;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class CouponCreate implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('shapin_stripe_coupon_create');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('id')
                    ->info('Unique string of your choice that will be used to identify this coupon when applying it to a customer. This is often a specific code you’ll give to your customer to use when signing up (e.g., FALL25OFF). If you don’t want to specify a particular code, you can leave the ID blank and we’ll generate a random code for you.')
                ->end()
                ->enumNode('duration')
                    ->isRequired()
                    ->values([Coupon::DURATION_FOREVER, Coupon::DURATION_ONCE, Coupon::DURATION_REPEATING])
                    ->info('Specifies how long the discount will be in effect. Can be forever, once, or repeating.')
                ->end()
                ->integerNode('amount_off')
                    ->info('A positive integer representing the amount to subtract from an invoice total (required if percent_off is not passed).')
                ->end()
                ->scalarNode('currency')
                    ->info('Three-letter ISO code for the currency of the amount_off parameter (required if amount_off is passed).')
                ->end()
                ->integerNode('duration_in_months')
                    ->info('Required only if duration is repeating, in which case it must be a positive integer that specifies the number of months the discount will be in effect.')
                ->end()
                ->integerNode('max_redemptions')
                    ->info('A positive integer specifying the number of times the coupon can be redeemed before it’s no longer valid. For example, you might have a 50% off coupon that the first 20 readers of your blog can use.')
                ->end()
                ->arrayNode('metadata')
                    ->scalarPrototype()->end()
                    ->info('Set of key-value pairs that you can attach to an object. This can be useful for storing additional information about the object in a structured format. Individual keys can be unset by posting an empty value to them. All keys can be unset by posting an empty value to metadata.')
                ->end()
                ->scalarNode('name')
                    ->info('Name of the coupon displayed to customers on, for instance invoices, or receipts. By default the id is shown if name is not set.')
                ->end()
                ->floatNode('percent_off')
                    ->info('A positive float larger than 0, and smaller or equal to 100, that represents the discount the coupon will apply (required if amount_off is not passed).')
                ->end()
                ->integerNode('redeem_by')
                    ->info('Unix timestamp specifying the last time at which the coupon can be redeemed. After the redeem_by date, the coupon can no longer be applied to new customers.')
                ->end()
            ->end()
        ;

        $rootNode
            ->validate()
                ->ifTrue(function ($v) {
                    return Coupon::DURATION_REPEATING === $v['duration'] && !isset($v['duration_in_months']);
                })
                ->thenInvalid('"duration_in_months" is required when using  "repeating" duration.')
            ->end()
            ->validate()
                ->ifTrue(function ($v) {
                    return isset($v['amount_off']) && !isset($v['currency']);
                })
                ->thenInvalid('"currency" is required when specifying  "amount_off".')
            ->end()
            ->validate()
                ->ifTrue(function ($v) {
                    return !isset($v['amount_off']) && !isset($v['percent_off']);
                })
                ->thenInvalid('You must specify either an "amount_off" or an "percent_off".')
            ->end()
        ;

        return $treeBuilder;
    }
}
