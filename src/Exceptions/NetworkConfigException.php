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
 * Class NetworkConfigException
 * @package CryptoLabs\Bitcoin\Exceptions
 */
class NetworkConfigException extends NodeException
{
    public const BAD_NETWORK_ID = 2;
    public const CONFIG_FILE_ERROR = 4;
    public const BAD_PARAM_VALUE = 8;

    /**
     * @return NetworkConfigException
     */
    public static function BadNetworkId(): self
    {
        return new self('Bad network ID', self::BAD_NETWORK_ID);
    }

    /**
     * @param string $message
     * @return NetworkConfigException
     */
    public static function ConfigFileError(string $message): self
    {
        return new self($message, self::CONFIG_FILE_ERROR);
    }

    /**
     * @param string $param
     * @param string|null $expected
     * @param string|null $got
     * @return NetworkConfigException
     */
    public static function BadParamValueType(string $param, ?string $expected = null, ?string $got = null): self
    {
        try {
            throw InvalidTypeException::Param("network." . $param, $expected, $got);
        } catch (InvalidTypeException $e) {
            return new self($e->getMessage(), self::BAD_PARAM_VALUE);
        }
    }
}