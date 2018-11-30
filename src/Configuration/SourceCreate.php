<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Shapin\Stripe\Model\Source\Source;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class SourceCreate implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('shapin_stripe');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->validate()
                ->ifTrue(function ($v) {
                    return isset($v['usage']) && Source::USAGE_SINGLE_USE === $v['usage'] && !isset($v['amount']);
                })
                ->thenInvalid('"amount" is required for "single_use" sources.')
            ->end()
            ->validate()
                ->ifTrue(function ($v) {
                    return isset($v['receiver']) && (!isset($v['flow']) || Source::FLOW_RECEIVER !== $v['flow']);
                })
                ->thenInvalid('"receiver" can be set only for "receiver" flow.')
            ->end()
            ->validate()
                ->ifTrue(function ($v) {
                    return isset($v['flow']) && Source::FLOW_REDIRECT === $v['flow'] && !isset($v['redirect']);
                })
                ->thenInvalid('"redirect" must be set when using "redirect" flow.')
            ->end()
            ->validate()
                ->ifTrue(function ($v) {
                    return isset($v['type']) && Source::TYPE_THREE_D_SECURE === $v['type'] && !isset($v['three_d_secure']);
                })
                ->thenInvalid('"three_d_secure" must be set when using "three_d_secure" source type.')
            ->end()
            ->validate()
                ->ifTrue(function ($v) {
                    return isset($v['type']) && Source::TYPE_THREE_D_SECURE === $v['type'] && !isset($v['redirect']);
                })
                ->thenInvalid('"redirect" must be set when using "three_d_secure" source type.')
            ->end()
            ->children()
                ->scalarNode('type')
                    ->isRequired()
                    ->info('The type of the source to create. Required unless customer and original_source are specified (see the Shared card Sources guide)')
                ->end()
                ->scalarNode('amount')
                    ->info('Amount associated with the source. This is the amount for which the source will be chargeable once ready. Required for single_use sources.')
                ->end()
                ->scalarNode('currency')
                    ->info('Three-letter ISO code for the currency associated with the source. This is the currency for which the source will be chargeable once ready.')
                ->end()
                ->enumNode('flow')
                    ->cannotBeEmpty()
                    ->values([Source::FLOW_CODE_VERIFICATION, Source::FLOW_NONE, Source::FLOW_RECEIVER, Source::FLOW_REDIRECT])
                    ->info('The authentication flow of the source to create. flow is one of redirect, receiver, code_verification, none. It is generally inferred unless a type supports multiple flows.')
                ->end()
                ->arrayNode('mandate')
                    ->children()
                        ->arrayNode('acceptance')
                            ->children()
                                ->integerNode('date')
                                    ->isRequired()
                                    ->info('The unix timestamp the mandate was accepted or refused at by the customer.')
                                ->end()
                                ->scalarNode('ip')
                                    ->isRequired()
                                    ->info('The IP address from which the mandate was accepted or refused by the customer.')
                                ->end()
                                ->enumNode('status')
                                    ->isRequired()
                                    ->cannotBeEmpty()
                                    ->values([Source::STATUS_ACCEPTED, Source::STATUS_REFUSED])
                                    ->info('The status of the mandate acceptance. Either accepted (the mandate was accepted) or refused (the mandate was refused).')
                                ->end()
                                ->scalarNode('user_agent')
                                    ->isRequired()
                                    ->info('The user agent of the browser from which the mandate was accepted or refused by the customer. This can be unset by updating the value to null and then saving.')
                                ->end()
                            ->end()
                            ->info('The parameters required to notify Stripe of a mandate acceptance or refusal by the customer.')
                        ->end()
                        ->enumNode('notification_method')
                            ->cannotBeEmpty()
                            ->values([Source::NOTIFICATION_METHOD_EMAIL, Source::NOTIFICATION_METHOD_MANUAL, Source::NOTIFICATION_METHOD_NONE])
                            ->info('The method Stripe should use to notify the customer of upcoming debit instructions and/or mandate confirmation as required by the underlying debit network. Either email (an email is sent directly to the customer), manual (a source.mandate_notification event is sent to your webhooks endpoint and you should handle the notification) or none (the underlying debit network does not require any notification).')
                        ->end()
                    ->end()
                    ->info('Information about a mandate possiblity attached to a source object (generally for bank debits) as well as its acceptance status.')
                ->end()
                ->arrayNode('metadata')
                    ->scalarPrototype()->end()
                    ->info('A set of key/value pairs that you can attach to a source object. It can be useful for storing additional information about the source in a structured format.')
                ->end()
                ->arrayNode('owner')
                    ->children()
                        ->arrayNode('address')
                            ->isRequired()
                            ->children()
                                ->scalarNode('city')->end()
                                ->scalarNode('country')->end()
                                ->scalarNode('line1')->end()
                                ->scalarNode('line2')->end()
                                ->scalarNode('postal_code')->end()
                                ->scalarNode('state')->end()
                            ->end()
                            ->info('Shipping address.')
                        ->end()
                        ->scalarNode('email')->end()
                        ->scalarNode('name')->end()
                        ->scalarNode('phone')->end()
                    ->end()
                    ->info('Shipping information for the charge. Helps prevent fraud on charges for physical goods.')
                ->end()
                ->arrayNode('receiver')
                    ->children()
                        ->enumNode('refund_attributes_method')
                            ->cannotBeEmpty()
                            ->values([Source::REFUND_ATTRIBUTES_METHOD_EMAIL, Source::REFUND_ATTRIBUTES_METHOD_MANUAL])
                            ->info('The method Stripe should use to request information needed to process a refund or mispayment. Either email (an email is sent directly to the customer) or manual (a source.refund_attributes_required event is sent to your webhooks endpoint). Refer to each payment method’s documentation to learn which refund attributes may be required.')
                        ->end()
                    ->end()
                    ->info('Optional parameters for the receiver flow. Can be set only if the source is a receiver (flow is receiver).')
                ->end()
                ->arrayNode('redirect')
                    ->children()
                        ->scalarNode('return_url')
                            ->isRequired()
                            ->info('The URL you provide to redirect the customer back to you after they authenticated their payment. It can use your application URI scheme in the context of a mobile application.')
                        ->end()
                    ->end()
                    ->info('Parameters required for the redirect flow. Required if the source is authenticated by a redirect (flow is redirect).')
                ->end()
                ->scalarNode('statement_descriptor')
                    ->info('An arbitrary string to be displayed on your customer’s statement. As an example, if your website is RunClub and the item you’re charging for is a race ticket, you may want to specify a statement_descriptor of RunClub 5K race ticket. While many payment types will display this information, some may not display it at all.')
                ->end()
                ->arrayNode('three_d_secure')
                    ->children()
                        ->scalarNode('card')
                            ->info('The ID of the card source.')
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('token')
                    ->info('An optional token used to create the source. When passed, token properties will override source parameters.')
                ->end()
                ->enumNode('usage')
                    ->cannotBeEmpty()
                    ->values([Source::USAGE_REUSABLE, Source::USAGE_SINGLE_USE])
                    ->info('Either reusable or single_use. Whether this source should be reusable or not. Some source types may or may not be reusable by construction, while other may leave the option at creation. If an incompatible value is passed, an error will be returned.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
