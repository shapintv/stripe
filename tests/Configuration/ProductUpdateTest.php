<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Tests\Configuration;

use PHPUnit\Framework\TestCase;
use Shapin\Stripe\Configuration\ProductUpdate;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

class ProductUpdateTest extends TestCase
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
        $processor->processConfiguration(new ProductUpdate(), [$config]);
    }

    public function configProvider()
    {
        // ## VALID
        // Full example
        yield [[
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
        // Too many attributes
        yield [['attributes' => ['attr1', 'attr2', 'attr3', 'attr4', 'attr5', 'attr6']], 'You can have up to 5 attributes.'];
        // Too many images
        yield [['images' => ['img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'img7', 'img8', 'img9']], 'You can have up to 8 images.'];
    }
}
