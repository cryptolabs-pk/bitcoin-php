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

namespace CryptoLabs\Bitcoin;

use CryptoLabs\Bitcoin\Exceptions\NetworkConfigException;
use CryptoLabs\DataTypes\Base16;

/**
 * Class Network
 * @package CryptoLabs\Bitcoin
 * @property-read int $scale
 * @property-read Base16 $base58PrefixP2PKH
 * @property-read Base16 $base58PrefixP2SH
 * @property-read Base16 $base58PrefixWIF
 * @property-read Base16 $base58PrefixBIP32_Private
 * @property-read Base16 $base58PrefixBIP32_Public
 * @property-read int $bip44CoinIndex
 */
class Network
{
    private const PREG_NETWORK_ID = '/^[\w\-]{2,16}$/';
    private const PREG_NETWORK_NAME = '/^[\w\s]{2,16}$/';

    /** @var array */
    private static $instances = [];

    /** @var string */
    private $name;
    /** @var int */
    private $scale;
    /** @var null|Base16 */
    private $base58PrefixP2PKH;
    /** @var null|Base16 */
    private $base58PrefixP2SH;
    /** @var null|Base16 */
    private $base58PrefixWIF;
    /** @var null|Base16 */
    private $base58PrefixBIP32_Private;
    /** @var null|Base16 */
    private $base58PrefixBIP32_Public;
    /** @var null|int */
    private $bip44CoinIndex;

    /**
     * Gets a network instance, if network with same ID was instantiated, same instance will be returned
     * @param string $id
     * @param string|null $jsonFilePath
     * @return Network
     * @throws NetworkConfigException
     */
    public static function Get(string $id, ?string $jsonFilePath = null): self
    {
        if (!preg_match(self::PREG_NETWORK_ID, $id)) {
            throw NetworkConfigException::BadNetworkId();
        }

        if (isset(static::$instances[$id])) {
            return static::$instances[$id];
        }

        $instance = new self($id, $jsonFilePath);
        static::$instances[$id] = $instance;
        return $instance;
    }

    /**
     * Flush all loaded Network instances from memory
     * @return void
     */
    public static function Flush(): void
    {
        static::$instances = [];
    }

    /**
     * Network constructor.
     * @param string $id
     * @param string|null $jsonFilePath
     * @throws NetworkConfigException
     */
    private function __construct(string $id, ?string $jsonFilePath = null)
    {
        if (!$jsonFilePath) {
            $jsonFilePath = dirname(__DIR__) . "/config/networks/" . $id . ".json";
        }

        $jsonFileContents = file_get_contents($jsonFilePath);
        if (!$jsonFileContents) {
            throw NetworkConfigException::ConfigFileError(sprintf('Could not read network "%s" config file', $id));
        }

        $json = json_decode(trim($jsonFileContents), true);
        if (!is_array($json)) {
            throw NetworkConfigException::ConfigFileError(sprintf('Failed to JSON decode "%s" network config', $id));
        }

        // Basic validations
        $this->name = $json["name"];
        if (!is_string($this->name)) {
            throw NetworkConfigException::BadParamValueType("name", "String", gettype($this->scale));
        } elseif (!preg_match(self::PREG_NETWORK_NAME, $this->name)) {
            throw NetworkConfigException::BadParamValueType("name");
        }

        // Basic validations
        $this->scale = $json["scale"];
        if (!is_int($this->scale)) {
            throw NetworkConfigException::BadParamValueType("scale", "Integer", gettype($this->scale));
        } elseif ($this->scale <= 0) {
            throw NetworkConfigException::BadParamValueType("scale");
        }

        // Prefixes
        $this->base58PrefixP2PKH = $json["base58"]["prefix"]["p2pkh"] ?? null;
        $this->base58PrefixP2SH = $json["base58"]["prefix"]["p2sh"] ?? null;
        $this->base58PrefixWIF = $json["base58"]["prefix"]["wif"] ?? null;
        $this->base58PrefixBIP32_Private = $json["base58"]["prefix"]["bip32"]["private"] ?? null;
        $this->base58PrefixBIP32_Public = $json["base58"]["prefix"]["bip32"]["public"] ?? null;
        foreach (["P2PKH", "P2SH", "WIF", "BIP32_Private", "BIP32_Public"] as $prefix) {
            $prop = "base58Prefix" . $prefix;
            $value = $this->$prop;
            if (!is_string($value)) {
                throw NetworkConfigException::BadParamValueType("network.base58.prefix." . $prefix);
            }

            try {
                $this->$prop = Base16::Decode($value)->readOnly(true);
            } catch (\Exception $e) {
                throw NetworkConfigException::BadParamValueType("network.base58.prefix." . $prefix);
            }

            unset($prop, $value);
        }

        // BIP44
        $this->bip44CoinIndex = $json["bip44"]["coinIndex"] ?? null;
        if (!is_null($this->bip44CoinIndex)) {
            if (!is_int($this->bip44CoinIndex)) {
                throw NetworkConfigException::BadParamValueType("bip44.coinType", "Integer");
            }
        }
    }

    /**
     * @return array
     */
    public function __debugInfo(): array
    {
        return [sprintf('%s Network Config', $this->name)];
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @param $prop
     * @return mixed
     * @throws NetworkConfigException
     */
    public function __get($prop)
    {
        switch ($prop) {
            case "scale":
            case "base58PrefixP2PKH":
            case "base58PrefixP2SH":
            case "base58PrefixWIF":
            case "base58PrefixBIP32_Private":
            case "base58PrefixBIP32_Public":
            case "bip44CoinIndex":
                return $this->$prop;
            default:
                throw new NetworkConfigException('Cannot get property of inaccessible Network configuration');
        }
    }
}