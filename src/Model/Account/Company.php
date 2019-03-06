<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Account;

use Shapin\Stripe\Model\Address;
use Shapin\Stripe\Model\CreatableFromArray;

final class Company implements CreatableFromArray
{
    /**
     * @var ?Address
     */
    private $address;

    /**
     * @var ?Address
     */
    private $addressKana;

    /**
     * @var ?Address
     */
    private $addressKanji;

    /**
     * @var bool
     */
    private $directorsProvided;

    /**
     * @var ?string
     */
    private $name;

    /**
     * @var ?string
     */
    private $nameKana;

    /**
     * @var ?string
     */
    private $nameKanji;

    /**
     * @var bool
     */
    private $ownersProvided;

    /**
     * @var ?string
     */
    private $phone;

    /**
     * @var bool
     */
    private $taxIdProvided;

    /**
     * @var string
     */
    private $taxIdRegistrar;

    /**
     * @var bool
     */
    private $vatIdProvided;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->address = isset($data['address']) ? Address::createFromArray($data['address']) : null;
        $model->addressKana = isset($data['address_kana']) ? Address::createFromArray($data['address_kana']) : null;
        $model->addressKanji = isset($data['address_kanji']) ? Address::createFromArray($data['address_kanji']) : null;
        $model->directorsProvided = isset($data['directors_provided']) ? (bool) $data['owners_provided'] : false;
        $model->name = $data['name'] ?? null;
        $model->nameKana = $data['name_kana'] ?? null;
        $model->nameKanji = $data['name_kanji'] ?? null;
        $model->ownersProvided = isset($data['owners_provided']) ? (bool) $data['owners_provided'] : false;
        $model->phone = $data['phone'] ?? null;
        $model->taxIdProvided = (bool) $data['tax_id_provided'];
        $model->taxIdRegistrar = $data['tax_id_registrar'] ?? null;
        $model->vatIdProvided = (bool) $data['vat_id_provided'];

        return $model;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function getAddressKana(): ?Address
    {
        return $this->addressKana;
    }

    public function getAddressKanji(): ?Address
    {
        return $this->addressKanji;
    }

    public function areDirectorsProvided(): bool
    {
        return $this->directorsProvided;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getNameKana(): ?string
    {
        return $this->nameKana;
    }

    public function getNameKanji(): ?string
    {
        return $this->nameKanji;
    }

    public function areOwnersProvided(): bool
    {
        return $this->ownersProvided;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function isTaxIdProvided(): bool
    {
        return $this->taxIdProvided;
    }

    public function getTaxIdRegistrar(): ?string
    {
        return $this->taxIdRegistrar;
    }

    public function isVatIdProvided(): bool
    {
        return $this->vatIdProvided;
    }
}
