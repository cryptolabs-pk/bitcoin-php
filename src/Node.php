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

use CryptoLabs\Bitcoin\Wallets\KeyPair;

/**
 * Class Node
 * @package CryptoLabs\Bitcoin
 */
class Node
{
    /** @var Network */
    private $network;
    /** @var KeyPair */
    private $keyPair;

    /**
     * Node constructor.
     * @param Network $network
     */
    public function __construct(Network $network)
    {
        $this->network = $network;
        $this->keyPair = new KeyPair($this);
    }

    /**
     * @return Network
     */
    public function network(): Network
    {
        return $this->network;
    }

    /**
     * @return KeyPair
     */
    public function keyPair(): KeyPair
    {
        return $this->keyPair;
    }
}