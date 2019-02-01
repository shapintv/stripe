<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Shapin\Stripe\Model\Plan\Plan;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class PlanUpdate implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('shapin_stripe');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('plan')
                    ->isRequired()
                    ->info('The identifier of the plan to be updated.')
                ->end()
                ->booleanNode('active')
                    ->info('Whether the plan is currently available for new subscriptions.')
                ->end()
                ->arrayNode('metadata')
                    ->scalarPrototype()->end()
                    ->info('A set of key-value pairs that you can attach to a plan object. It can be useful for storing additional information about the plan in a structured format. ')
                ->end()
                ->scalarNode('nickname')
                    ->info('A brief description of the plan, hidden from customers. This will be unset if you POST an empty value.')
                ->end()
                ->scalarNode('product')
                    ->info('The product the plan belongs to. Note that after updating, statement descriptors and line items of the plan in active subscriptions will be affected.')
                ->end()
                ->integerNode('trial_period_days')
                    ->info('Default number of trial days when subscribing a customer to this plan using trial_from_plan=true.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
