<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Shapin\Stripe\Model\PaymentIntent\PaymentIntent;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class PaymentIntentConfirm implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('shapin_stripe');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->booleanNode('off_session')
                    ->info('Set to true to indicate that the customer is not in your checkout flow during this payment attempt, and therefore is unable to authenticate. This parameter is intended for scenarios where you collect card details and charge them later.')
                ->end()
                ->scalarNode('payment_method')
                    ->info('ID of the payment method (a PaymentMethod, Card, BankAccount, or saved Source object) to attach to this PaymentIntent.')
                ->end()
                ->booleanNode('save_payment_method')
                    ->info('If the PaymentIntent has a payment_method and a customer or if you’re attaching a payment method to the PaymentIntent in this request, you can pass save_payment_method=true to save the payment method to the customer. Defaults to false. If the payment method is already saved to a customer, this does nothing. If this type of payment method cannot be saved to a customer, the request will error.')
                ->end()
                ->enumNode('setup_future_usage')
                    ->values(['on_session', 'off_session'])
                    ->info('Indicates that you intend to make future payments with this PaymentIntent’s payment method.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
