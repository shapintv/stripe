<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Api;

use Shapin\Stripe\Exception;
use Shapin\Stripe\Model\BankAccount\BankAccount as BankAccountModel;
use Shapin\Stripe\Model\BankAccount\BankAccountCollection;

final class BankAccount extends HttpApi
{
    /**
     * @throws Exception
     */
    public function get(string $customerId, string $bankAccountId)
    {
        $response = $this->httpGet("/v1/customers/$customerId/sources/$bankAccountId");

        return $this->hydrator->hydrate($response, BankAccountModel::class);
    }

    /**
     * @throws Exception
     */
    public function all(string $customerId, array $params = [])
    {
        $params['object'] = 'bank_account';

        $response = $this->httpGet("/v1/customers/$customerId/sources", $params);

        return $this->hydrator->hydrate($response, BankAccountCollection::class);
    }
}
