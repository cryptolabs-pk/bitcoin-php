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
 * Class InvalidArgumentException
 * @package CryptoLabs\Bitcoin\Exceptions
 */
class InvalidArgumentException extends InvalidTypeException
{
    /**
     * @param int $num
     * @param string|null $method
     * @param string|null $excepted
     * @param string|null $got
     * @return InvalidArgumentException
     */
    public static function Arg(int $num, ?string $method = null, ?string $excepted = null, ?string $got = null): self
    {
        // Which argument
        switch ($num) {
            case 1:
                $message = "First argument";
                break;
            case 2:
                $message = "Second argument";
                break;
            default:
                $message = "Argument " . $num;
                break;
        }

        // Method
        if ($method) {
            $message .= sprintf(' for "%s"', $method);
        }

        $message .= ' is invalid';

        // Expected Data Type
        if ($excepted) {
            $message .= sprintf(', expected "%s"', $excepted);
        }

        // Passed Data Type
        if ($got) {
            $message .= sprintf(', got "%s"', $got);
        }

        return new self($message);
    }
}