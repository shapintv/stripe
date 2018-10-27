<?php

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Exception\Domain;

use Shapin\Stripe\Exception\DomainException;

final class UnknownErrorException extends \Exception implements DomainException
{
}
