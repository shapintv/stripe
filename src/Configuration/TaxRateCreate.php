<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class TaxRateCreate implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('shapin_stripe');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('display_name')
                    ->isRequired()
                    ->info('The display name of the tax rate, which will be shown to users.')
                ->end()
                ->booleanNode('inclusive')
                    ->isRequired()
                    ->info('This specifies if the tax rate is inclusive or exclusive.')
                ->end()
                ->floatNode('percentage')
                    ->isRequired()
                    ->info('This represents the tax rate percent out of 100.')
                ->end()
                ->booleanNode('active')
                    ->info('Flag determining whether the tax rate is active or inactive. Inactive tax rates continue to work where they are currently applied however they cannot be used for new applications.')
                ->end()
                ->scalarNode('description')
                    ->info('An arbitrary string attached to the tax rate for your internal use only. It will not be visible to your customers.')
                ->end()
                ->scalarNode('jurisdiction')
                    ->info('The jurisdiction for the tax rate.')
                ->end()
                ->arrayNode('metadata')
                    ->scalarPrototype()->end()
                    ->info('Set of key-value pairs that you can attach to an object. This can be useful for storing additional information about the object in a structured format. Individual keys can be unset by posting an empty value to them. All keys can be unset by posting an empty value to metadata.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
