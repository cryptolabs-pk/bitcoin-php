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

namespace CryptoLabs\Bitcoin\Wallets;

use CryptoLabs\Bitcoin\Base58\Base58Check;
use CryptoLabs\Bitcoin\Exceptions\InvalidTypeException;
use CryptoLabs\DataTypes\Base16;
use CryptoLabs\DataTypes\DataTypes;

/**
 * Class WIF
 * https://en.bitcoin.it/wiki/Wallet_import_format
 * @package CryptoLabs\Bitcoin\Wallets
 */
class WIF
{
    /**
     * Encodes as private key into WIF (wallet import format)
     * NOTE: parameter 1 expects network prefix as DECIMAL and NOT Base16
     * @param int $networkPrefix
     * @param string $privateKey
     * @param bool $isCompressed
     * @return string
     * @throws InvalidTypeException
     */
    public static function Encode(int $networkPrefix, string $privateKey, bool $isCompressed = true): string
    {
        if (!DataTypes::isBase16($privateKey)) {
            throw InvalidTypeException::Param("WIF::Encode.privateKey", "Base16");
        }

        // If the private key will correspond to a compressed public key...
        if ($isCompressed) {
            $privateKey .= "01"; // append 0x01 byte
        }

        $raw = dechex($networkPrefix) . $privateKey;
        return Base58Check::Encode(Base16::Decode($raw))->get();
    }
}