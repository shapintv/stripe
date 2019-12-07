<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class InvoicePay implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('shapin_stripe');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->booleanNode('forgive')
                    ->info('In cases where the source used to pay the invoice has insufficient funds, passing forgive=true controls whether a charge should be attempted for the full amount available on the source, up to the amount to fully pay the invoice. This effectively forgives the difference between the amount available on the source and the amount due. Passing forgive=false will fail the charge if the source hasn’t been pre-funded with the right amount. An example for this case is with ACH Credit Transfers and wires: if the amount wired is less than the amount due by a small amount, you might want to forgive the difference.')
                ->end()
                ->booleanNode('off_session')
                    ->info('Indicates if a customer is on or off-session while an invoice payment is attempted.')
                ->end()
                ->booleanNode('paid_out_of_band')
                    ->info('Boolean representing whether an invoice is paid outside of Stripe. This will result in no charge being made.')
                ->end()
                ->scalarNode('payment_method')
                    ->info('A PaymentMethod to be charged. The PaymentMethod must be the ID of a PaymentMethod belonging to the customer associated with the invoice being paid.')
                ->end()
                ->scalarNode('source')
                    ->info('A payment source to be charged. The source must be the ID of a source belonging to the customer associated with the invoice being paid.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
