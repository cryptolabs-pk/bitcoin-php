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

namespace CryptoLabs\Bitcoin\Nodes;

use CryptoLabs\Bitcoin\Exceptions\NodeException;
use CryptoLabs\Bitcoin\Network;
use CryptoLabs\Bitcoin\Node;

/**
 * Class AbstractCryptoNode
 * @package CryptoLabs\Bitcoin\Nodes
 */
abstract class AbstractCryptoNode extends Node
{
    protected const NETWORK_ID = null;

    /**
     * @return AbstractCryptoNode
     * @throws NodeException
     * @throws \CryptoLabs\Bitcoin\Exceptions\NetworkConfigException
     */
    final public static function Node(): self
    {
        return new static();
    }

    /**
     * AbstractCryptoNode constructor.
     * @throws NodeException
     * @throws \CryptoLabs\Bitcoin\Exceptions\NetworkConfigException
     */
    final public function __construct()
    {
        $networkId = static::NETWORK_ID;
        if (!is_string($networkId)) {
            throw new NodeException(sprintf('"%s" has not defined "NETWORK_ID" constant', get_called_class()));
        }

        parent::__construct(Network::Get($networkId));
    }
}