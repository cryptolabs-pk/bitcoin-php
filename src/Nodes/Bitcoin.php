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

/**
 * Class Bitcoin
 * @package CryptoLabs\Bitcoin\Nodes
 */
class Bitcoin extends AbstractCryptoNode
{
    protected const NETWORK_ID = "bitcoin";
}