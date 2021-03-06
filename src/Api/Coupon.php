<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Configuration;
use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\Coupon\Coupon as CouponModel;
use Shapin\Stripe\Model\Coupon\CouponCollection;
use Symfony\Component\Config\Definition\Processor;

final class Coupon extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $id)
    {
        $response = $this->httpGet("coupons/$id");

        return $this->hydrator->hydrate($response, CouponModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(array $params = [])
    {
        $response = $this->httpGet('coupons', $params);

        return $this->hydrator->hydrate($response, CouponCollection::class);
    }

    /**
     * @throws Exception
     */
    public function create(array $params)
    {
        $processor = new Processor();
        $params = $processor->processConfiguration(new Configuration\CouponCreate(), [$params]);

        $response = $this->httpPost('coupons', $params);

        return $this->hydrator->hydrate($response, CouponModel::class);
    }
}
