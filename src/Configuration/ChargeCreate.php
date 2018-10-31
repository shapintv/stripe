<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class ChargeCreate implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('shapin_stripe');

        $rootNode
            ->children()
                ->integerNode('amount')
                    ->isRequired()
                    ->info('A positive integer representing how much to charge, in the smallest currency unit (e.g., 100 cents to charge $1.00, or 100 to charge ¥100, a zero-decimal currency). The minimum amount is $0.50 USD or equivalent in charge currency.')
                ->end()
                ->scalarNode('currency')
                    ->isRequired()
                    ->info('Three-letter ISO currency code, in lowercase. Must be a supported currency.')
                ->end()
                ->integerNode('application_fee')
                    ->info('A fee in cents that will be applied to the charge and transferred to the application owner’s Stripe account. The request must be made with an OAuth key or the Stripe-Account header in order to take an application fee. For more information, see the application fees documentation.')
                ->end()
                ->booleanNode('capture')
                    ->info('Whether to immediately capture the charge. When false, the charge issues an authorization (or pre-authorization), and will need to be captured later. Uncaptured charges expire in seven days. For more information, see the authorizing charges and settling later documentation.')
                ->end()
                ->scalarNode('customer')
                    ->info('The ID of an existing customer that will be associated with this request. This field may only be updated if there is no existing associated customer with this charge.')
                ->end()
                ->scalarNode('description')
                    ->info('An arbitrary string which you can attach to a charge object. It is displayed when in the web interface alongside the charge. Note that if you use Stripe to send automatic email receipts to your customers, your receipt emails will include the description of the charge(s) that they are describing. This will be unset if you POST an empty value.')
                ->end()
                ->arrayNode('destination')
                    ->children()
                        ->scalarNode('account')
                            ->isRequired()
                            ->info('ID of an existing, connected Stripe account.')
                        ->end()
                        ->integerNode('amount')
                            ->info('The amount to transfer to the destination account without creating an Application Fee object. Cannot be combined with the application_fee parameter. Must be less than or equal to the charge amount.')
                        ->end()
                    ->end()
                    ->info('A set of key/value pairs you can attach to a charge giving information about its riskiness. If you believe a charge is fraudulent, include a user_report key with a value of fraudulent. If you believe a charge is safe, include a user_report key with a value of safe. Note that you must refund a charge before setting the user_report to fraudulent. Stripe will use the information you send to improve our fraud detection algorithms.')
                ->end()
                ->arrayNode('metadata')
                    ->scalarPrototype()->end()
                    ->info('Set of key-value pairs that you can attach to an object. This can be useful for storing additional information about the object in a structured format. Individual keys can be unset by posting an empty value to them. All keys can be unset by posting an empty value to metadata.')
                ->end()
                ->scalarNode('on_behalf_of')
                    ->info('The Stripe account ID for which these funds are intended. Automatically set if you use the destination parameter. For details, see Creating Separate Charges and Transfers.')
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
                ->scalarNode('source')
                    ->info('A payment source to be charged. This can be the ID of a card (i.e., credit or debit card), a bank account, a source, a token, or a connected account. For certain sources—namely, cards, bank accounts, and attached sources—you must also pass the ID of the associated customer.')
                ->end()
                ->scalarNode('statement_descriptor')
                    ->info('An arbitrary string to be displayed on your customer’s credit card statement. This can be up to 22 characters. As an example, if your website is RunClub and the item you’re charging for is a race ticket, you might want to specify a statement_descriptor of RunClub 5K race ticket. The statement description must contain at least one letter, must not contain <>"\' characters, and will appear on your customer’s statement in capital letters. Non-ASCII characters are automatically stripped. While most banks and card issuers display this information consistently, some might display it incorrectly or not at all.')
                ->end()
                ->scalarNode('transfer_group')
                    ->info('A string that identifies this transaction as part of a group. transfer_group may only be provided if it has not been set')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
