<?php
/**
 * This file is a part of "cryptolabs-pk/bitcoin-php" package.
 * https://github.com/cryptolabs-pk/bitcoin-php
 *
 * Copyright (c) 2019 Furqan A. Siddiqui <hello@furqansiddiqui.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code or visit following link:
 * https://github.com/cryptolabs-pk/bitcoin-php/blob/master/LICENSE
 */

declare(strict_types=1);

namespace CryptoLabs\Bitcoin\Exceptions;

/**
 * Class InvalidTypeException
 * @package CryptoLabs\Bitcoin\Exceptions
 */
class InvalidTypeException extends NodeException
{
    /**
     * @param string $param
     * @param string|null $excepted
     * @param string|null $got
     * @return InvalidTypeException
     */
    public static function Param(string $param, ?string $excepted = null, ?string $got = null): self
    {
        $message = sprintf('Invalid value for param "%s"', $param);
        if ($excepted) {
            $message .= sprintf(', expected "%s"', $excepted);
        }

        if ($got) {
            $message .= sprintf(', got "%s"', $got);
        }

        return new self($message);
    }
}