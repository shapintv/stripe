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

class PaymentIntentCreate implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('shapin_stripe');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->integerNode('amount')
                    ->isRequired()
                    ->info('A positive integer representing how much to charge in the smallest currency unit (e.g., 100 cents to charge $1.00 or 100 to charge ¥100, a zero-decimal currency). The minimum amount is $0.50 US or equivalent in charge currency. The amount value supports up to eight digits (e.g., a value of 99999999 for a USD charge of $999,999.99).')
                ->end()
                ->scalarNode('currency')
                    ->isRequired()
                    ->info('Three-letter ISO currency code, in lowercase. Must be a supported currency.')
                ->end()
                ->integerNode('application_fee_amount')
                    ->info('The amount of the application fee (if any) that will be applied to the payment and transferred to the application owner’s Stripe account. For more information, see the PaymentIntents use case for connected accounts.')
                ->end()
                ->enumNode('capture_method')
                    ->cannotBeEmpty()
                    ->values([PaymentIntent::CAPTURE_METHOD_MANUAL, PaymentIntent::CAPTURE_METHOD_AUTOMATIC])
                    ->info('One of automatic (default) or manual. When the capture method is automatic, Stripe automatically captures funds when the customer authorizes the payment. Change capture_method to manual if you wish to separate authorization and capture for payment methods that support this.')
                ->end()
                ->booleanNode('confirm')
                    ->info('Set to true to attempt to confirm this PaymentIntent immediately. This parameter defaults to false. When creating and confirming a PaymentIntent at the same time, parameters available in the confirm API may also be provided.')
                ->end()
                ->enumNode('confirmation_method')
                    ->cannotBeEmpty()
                    ->values([PaymentIntent::CONFIRMATION_METHOD_MANUAL, PaymentIntent::CONFIRMATION_METHOD_AUTOMATIC])
                    ->info('One of automatic (default) or manual. When the confirmation method is automatic, a PaymentIntent can be confirmed using a publishable key. After next_actions are handled, no additional confirmation is required to complete the payment. When the confirmation method is manual, all payment attempts must be made using a secret key. The PaymentIntent returns to the requires_confirmation state after handling next_actions, and requires your server to initiate each payment attempt with an explicit confirmation. Learn more about the different confirmation flows.')
                ->end()
                ->scalarNode('customer')
                    ->info('ID of the Customer this PaymentIntent belongs to, if one exists. If present, payment methods used with this PaymentIntent can only be attached to this Customer, and payment methods attached to other Customers cannot be used with this PaymentIntent.')
                ->end()
                ->scalarNode('description')
                    ->info('An arbitrary string attached to the object. Often useful for displaying to users. This can be unset by updating the value to null and then saving.')
                ->end()
                ->arrayNode('metadata')
                    ->scalarPrototype()->end()
                    ->info('A set of key/value pairs that you can attach to a source object. It can be useful for storing additional information about the source in a structured format.')
                ->end()
                ->booleanNode('off_session')
                    ->info('Set to true to indicate that the customer is not in your checkout flow during this payment attempt, and therefore is unable to authenticate. This parameter is intended for scenarios where you collect card details and charge them later. This parameter can only be used with confirm=true.')
                ->end()
                ->scalarNode('on_behalf_of')
                    ->info('The Stripe account ID for which these funds are intended. For details, see the PaymentIntents use case for connected accounts.')
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
                ->scalarNode('statement_descriptor')
                    ->info('For non-card charges, you can use this value as the complete description that appears on your customers’ statements. Must contain at least one letter, maximum 22 characters.')
                ->end()
                ->scalarNode('statement_descriptor_suffix')
                    ->info('Provides information about a card payment that customers see on their statements. Concatenated with the prefix (shortened descriptor) or statement descriptor that’s set on the account to form the complete statement descriptor. Maximum 22 characters for the concatenated descriptor.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
