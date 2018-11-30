<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class ChargeUpdate implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('shapin_stripe');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('customer')
                    ->info('The ID of an existing customer that will be associated with this request. This field may only be updated if there is no existing associated customer with this charge.')
                ->end()
                ->scalarNode('description')
                    ->info('An arbitrary string which you can attach to a charge object. It is displayed when in the web interface alongside the charge. Note that if you use Stripe to send automatic email receipts to your customers, your receipt emails will include the description of the charge(s) that they are describing. This will be unset if you POST an empty value.')
                ->end()
                ->arrayNode('fraud_details')
                    ->children()
                        ->enumNode('user_report')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->values(['fraudulent', 'safe'])
                        ->end()
                    ->end()
                    ->info('A set of key/value pairs you can attach to a charge giving information about its riskiness. If you believe a charge is fraudulent, include a user_report key with a value of fraudulent. If you believe a charge is safe, include a user_report key with a value of safe. Note that you must refund a charge before setting the user_report to fraudulent. Stripe will use the information you send to improve our fraud detection algorithms.')
                ->end()
                ->arrayNode('metadata')
                    ->scalarPrototype()->end()
                    ->info('Set of key-value pairs that you can attach to an object. This can be useful for storing additional information about the object in a structured format. Individual keys can be unset by posting an empty value to them. All keys can be unset by posting an empty value to metadata.')
                ->end()
                ->scalarNode('receipt_email')
                    ->info('This is the email address that the receipt for this charge will be sent to. If this field is updated, then a new email receipt will be sent to the updated address. This will be unset if you POST an empty value.')
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
                            ->info('Shipping address.')
                        ->end()
                        ->scalarNode('name')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->info('Recipient name. This will be unset if you POST an empty value.')
                        ->end()
                        ->scalarNode('carrier')
                            ->info('The delivery service that shipped a physical product, such as Fedex, UPS, USPS, etc. This will be unset if you POST an empty value.')
                        ->end()
                        ->scalarNode('phone')
                            ->info('Recipient phone (including extension). This will be unset if you POST an empty value.')
                        ->end()
                        ->scalarNode('tracking_number')
                            ->info('The tracking number for a physical product, obtained from the delivery service. If multiple tracking numbers were generated for this purchase, please separate them with commas. This will be unset if you POST an empty value.')
                        ->end()
                    ->end()
                    ->info('Shipping information for the charge. Helps prevent fraud on charges for physical goods.')
                ->end()
                ->scalarNode('trasnfer_group')
                    ->info('A string that identifies this transaction as part of a group. transfer_group may only be provided if it has not been set')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
