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

use CryptoLabs\Bitcoin\Node;

/**
 * Class KeyPair
 * @package CryptoLabs\Bitcoin\Wallets
 */
class KeyPair
{
    /** @var Node */
    private $node;

    /**
     * KeyPair constructor.
     * @param Node $node
     */
    public function __construct(Node $node)
    {
        $this->node = $node;
    }

    /**
     * @param string $hexits
     * @return PrivateKey
     * @throws \CryptoLabs\Bitcoin\Exceptions\Wallets\PrivateKeyConstructException
     */
    public function useEntropy(string $hexits): PrivateKey
    {
        return PrivateKey::Entropy($hexits, $this->node);
    }
}