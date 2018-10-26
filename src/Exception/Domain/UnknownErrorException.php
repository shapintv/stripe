<?php

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Shapin\Stripe\Exception\Domain;

use Shapin\Stripe\Exception\DomainException;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class UnknownErrorException extends \Exception implements DomainException
{
}
