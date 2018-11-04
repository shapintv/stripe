<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Model\Account;

use Shapin\Stripe\Model\Address;
use Shapin\Stripe\Model\CreatableFromArray;
use Shapin\Stripe\Model\DateOfBirth;

final class LegalEntity implements CreatableFromArray
{
    /**
     * @var array
     */
    private $additionalOwners;

    /**
     * @var Address
     */
    private $address;

    /**
     * @var ?string
     */
    private $businessName;

    /**
     * @var bool
     */
    private $businessTaxIdProvided;

    /**
     * @var ?DateOfBirth
     */
    private $dateOfBirth;

    /**
     * @var ?string
     */
    private $firstName;

    /**
     * @var ?string
     */
    private $lastName;

    /**
     * @var Address
     */
    private $personalAddress;

    /**
     * @var bool
     */
    private $personalIdNumberProvided;

    /**
     * @var bool
     */
    private $ssnLastFourProvided;

    /**
     * @var string
     */
    private $type;

    /**
     * @var LegalEntityVerification
     */
    private $verification;

    private function __construct()
    {
    }

    public static function createFromArray(array $data): self
    {
        $model = new self();
        $model->additionalOwners = $data['additional_owners'];
        $model->address = Address::createFromArray($data['address']);
        $model->businessName = $data['business_name'];
        $model->businessTaxIdProvided = (bool) $data['business_tax_id_provided'];
        if (null === $data['dob']['day'] || null === $data['dob']['month'] || null === $data['dob']['year']) {
            $model->dateOfBirth = null;
        } else {
            $model->dateOfBirth = new DateOfBirth($data['dob']['day'], $data['dob']['month'], $data['dob']['year']);
        }
        $model->firstName = $data['first_name'];
        $model->lastName = $data['last_name'];
        $model->personalAddress = Address::createFromArray($data['personal_address']);
        $model->personalIdNumberProvided = isset($data['personal_id_number_provided']) ? (bool) $data['personal_id_number_provided'] : false;
        $model->ssnLastFourProvided = isset($data['ssn_last_4_provided']) ? (bool) $data['ssn_last_4_provided'] : false;
        $model->type = $data['type'];
        $model->verification = LegalEntityVerification::createFromArray($data['verification']);

        return $model;
    }

    public function getAdditionalOwners(): array
    {
        return $this->additionalOwners;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getBusinessName(): ?string
    {
        return $this->businessName;
    }

    public function isBusinessTaxIdProvided(): bool
    {
        return $this->businessTaxIdProvided;
    }

    public function getDateOfBirth(): ?DateOfBirth
    {
        return $this->dateOfBirth;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getPersonalAddress(): Address
    {
        return $this->personalAddress;
    }

    public function isPersonalIdNumberProvided(): bool
    {
        return $this->personalIdNumberProvided;
    }

    public function areSsnLastFourProvided(): bool
    {
        return $this->ssnLastFourProvided;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getVerification(): LegalEntityVerification
    {
        return $this->verification;
    }
}
