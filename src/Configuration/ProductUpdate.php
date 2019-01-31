<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Shapin\Stripe\Model\Product\Product;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class ProductUpdate implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('shapin_stripe');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->booleanNode('active')
                    ->info('Whether the product is available for purchase.')
                ->end()
                ->arrayNode('attributes')
                    ->scalarPrototype()->end()
                    ->info('A list of up to 5 alphanumeric attributes that each SKU can provide values for (e.g., ["color", "size"]). If a value for attributes is specified, the list specified will replace the existing attributes list on this product. Any attributes not present after the update will be deleted from the SKUs for this product. This will be unset if you POST an empty value.')
                    ->validate()
                        ->ifTrue(function($c) {
                            return 5 < count($c);
                        })
                        ->thenInvalid('You can have up to 5 attributes.')
                    ->end()
                ->end()
                ->scalarNode('caption')
                    ->info('A short one-line description of the product, meant to be displayable to the customer.')
                ->end()
                ->arrayNode('deactivate_on')
                    ->prototype('scalar')->end()
                    ->info('An array of Connect application names or identifiers that should not be able to order the SKUs for this product. This will be unset if you POST an empty value.')
                ->end()
                ->scalarNode('description')
                    ->info('The product’s description, meant to be displayable to the customer.')
                ->end()
                ->arrayNode('images')
                    ->scalarPrototype()->end()
                    ->info('A list of up to 8 URLs of images for this product, meant to be displayable to the customer. This will be unset if you POST an empty value.')
                    ->validate()
                        ->ifTrue(function($c) {
                            return 8 < count($c);
                        })
                        ->thenInvalid('You can have up to 8 images.')
                    ->end()
                ->end()
                ->arrayNode('metadata')
                    ->scalarPrototype()->end()
                    ->info('A set of key-value pairs that you can attach to a product object. It can be useful for storing additional information about the product in a structured format.')
                ->end()
                ->scalarNode('name')
                    ->info('The product’s name, meant to be displayable to the customer. Applicable to both service and good types.')
                ->end()
                ->arrayNode('package_dimensions')
                    ->children()
                        ->floatNode('height')
                            ->isRequired()
                            ->info('Height, in inches. Maximum precision is 2 decimal places.')
                        ->end()
                        ->floatNode('length')
                            ->isRequired()
                            ->info('Length, in inches. Maximum precision is 2 decimal places.')
                        ->end()
                        ->floatNode('weight')
                            ->isRequired()
                            ->info('Weight, in ounces. Maximum precision is 2 decimal places.')
                        ->end()
                        ->floatNode('width')
                            ->isRequired()
                            ->info('Width, in inches. Maximum precision is 2 decimal places.')
                        ->end()
                    ->end()
                    ->info('The dimensions of this product for shipping purposes. A SKU associated with this product can override this value by having its own package_dimensions.')
                ->end()
                ->booleanNode('shippable')
                    ->info('Whether this product is shipped (i.e., physical goods). Defaults to true.')
                ->end()
                ->scalarNode('url')
                    ->info('A URL of a publicly-accessible webpage for this product.')
                ->end()
            ->end()
        ;

        $rootNode
            ->validate()
                ->always(function($c) {
                    if (empty($c['deactivate_on'])) {
                        unset($c['deactivate_on']);
                    }

                    return $c;
                })
            ->end()
        ;

        return $treeBuilder;
    }
}
