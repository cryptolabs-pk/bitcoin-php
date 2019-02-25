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

namespace CryptoLabs\Bitcoin\Base58;

use CryptoLabs\BcMath\BcNumber;
use CryptoLabs\Bitcoin\Base58\Result\Base58Encoded;
use CryptoLabs\DataTypes\Binary;

/**
 * Class Base58Check
 * @package CryptoLabs\Bitcoin\Base58
 */
class Base58Check
{
    /**
     * @param Binary $buffer
     * @return Base58Encoded
     */
    public static function Encode(Binary $buffer): Base58Encoded
    {
        $checksum = $buffer->copy();
        $checksum->hash()->digest("sha256", 2, 4); // 2 iterations of SHA256, get 4 bytes from final iteration
        $buffer->append($checksum->raw()); // Append checksum to passed binary data

        // Encode buffer in Base16, and pass to BcMath lib for conversion to integrals
        $decimals = BcNumber::Decode($buffer->get()->base16());

        return Base58::Encode($decimals);
    }
}