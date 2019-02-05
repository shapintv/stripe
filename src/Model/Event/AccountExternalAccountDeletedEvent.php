<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Event;

use Shapin\Stripe\Model\BankAccount\BankAccount;
use Shapin\Stripe\Model\Card\Card;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\Subscription\Subscription;

final class AccountExternalAccountDeletedEvent extends Event implements CreatableFromArray
{
    /**
     * @var ?BankAccount
     */
    private $bankAccount;

    /**
     * @var ?Card
     */
    private $card;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->apiVersion = $data['api_version'];
        $model->createdAt = new \DateTimeImmutable('@'.$data['created']);
        $model->pendingWebhooks = (int) $data['pending_webhooks'];
        $model->request = isset($data['request']) ? Request::createFromArray($data['request']) : null;
        $model->type = $data['type'];

        $object = $data['data']['object']['object'];
        if ('bank_account' === $object) {
            $model->bankAccount = BankAccount::createFromArray($data['data']['object']);
        } elseif ('card' === $object) {
            $model->card = Card::createFromArray($data['data']['object']);
        } else {
            throw new InvalidArgumentException("Unknown external account type: $object");
        }

        return $model;
    }

    public function getBankAccount(): ?BankAccount
    {
        return $this->bankAccount;
    }

    public function getCard(): ?Card
    {
        return $this->card;
    }
}
