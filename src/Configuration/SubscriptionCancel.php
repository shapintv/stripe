<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class SubscriptionCancel implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('shapin_stripe_subscription_cancel');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->booleanNode('invoice_now')
                    ->info('Will generate a final invoice that invoices for any un-invoiced metered usage and new/pending proration invoice items.')
                ->end()
                ->booleanNode('prorate')
                    ->info('Will generate a proration invoice item that credits remaining unused time until the subscription period end.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
