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

namespace CryptoLabs\Bitcoin\Exceptions\Wallets;

/**
 * Class PrivateKeyConstructException
 * @package CryptoLabs\Bitcoin\Exceptions\Wallets
 */
class PrivateKeyConstructException extends WalletsException
{
    public const INVALID_ENCODING = 2;
    public const INVALID_LENGTH = 4;

    /**
     * @return PrivateKeyConstructException
     */
    public static function EncodingException(): self
    {
        return new self('Private keys must be encoded in Base16', self::INVALID_ENCODING);
    }

    /**
     * @return PrivateKeyConstructException
     */
    public static function LengthException(): self
    {
        return new self('Private keys must be precisely 256-bit long', self::INVALID_LENGTH);
    }
}