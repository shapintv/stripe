<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Configuration;

use PHPUnit\Framework\TestCase;
use Shapin\Stripe\Configuration\ProductCreate;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

class ProductCreateTest extends TestCase
{
    /**
     * @dataProvider configProvider
     */
    public function testProcess(array $config, ?string $errorMessage = null)
    {
        if (null !== $errorMessage) {
            $this->expectException(InvalidConfigurationException::class);
            $this->expectExceptionMessage($errorMessage);
        } else {
            $this->expectNotToPerformAssertions();
        }

        $processor = new Processor();
        $processor->processConfiguration(new ProductCreate(), [$config]);
    }

    public function configProvider()
    {
        // ## VALID
        // Simple example
        yield [['name' => 'An awesome service', 'type' => 'service']];
        yield [['name' => 'An awesome object', 'type' => 'good']];
        // Full example
        yield [[
            'name' => 'An awesome object',
            'type' => 'good',
            'id' => 'my_custome_id',
            'active' => true,
            'attributes' => ['attr1', 'attr2'],
            'caption' => 'This is an awesome object!',
            'deactivate_on' => ['coucou', 'coucou2'],
            'description' => 'This is a full test',
            'images' => ['url1', 'url2'],
            'metadata' => [
                'key1' => null, // In order to remove key from existing metadata
                'key2' => 'amazing',
                'key3' => 'test',
            ],
            'package_dimensions' => [
                'height' => 1.23,
                'length' => 1.24,
                'weight' => 1.25,
                'width' => 1.26,
            ],
            'shippable' => true,
            'url' => 'product url',
        ]];

        // ## INVALID
        // Field reserved for goods with service product
        yield [['name' => 'My product', 'type' => 'service', 'caption' => 'test'], 'Invalid configuration for path "shapin_stripe": You can only set "caption" for "good" products.'];
        yield [['name' => 'My product', 'type' => 'service', 'deactivate_on' => ['test']], 'Invalid configuration for path "shapin_stripe": You can only set "deactivate_on" for "good" products.'];
        yield [['name' => 'My product', 'type' => 'service', 'description' => 'test'], 'Invalid configuration for path "shapin_stripe": You can only set "description" for "good" products.'];
        yield [['name' => 'My product', 'type' => 'service', 'package_dimensions' => ['height' => 1.01, 'length' => 1.02, 'weight' => 1.03, 'width' => 1.04]], 'Invalid configuration for path "shapin_stripe": You can only set "package_dimensions" for "good" products.'];
        yield [['name' => 'My product', 'type' => 'service', 'shippable' => true], 'Invalid configuration for path "shapin_stripe": You can only set "shippable" for "good" products.'];
        yield [['name' => 'My product', 'type' => 'service', 'url' => 'an_url'], 'Invalid configuration for path "shapin_stripe": You can only set "url" for "good" products.'];
        // Too many attributes
        yield [['name' => 'My product', 'type' => 'good', 'attributes' => ['attr1', 'attr2', 'attr3', 'attr4', 'attr5', 'attr6']], 'You can have up to 5 attributes.'];
        // Too many images
        yield [['name' => 'My product', 'type' => 'good', 'images' => ['img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'img7', 'img8', 'img9']], 'You can have up to 8 images.'];
    }
}
