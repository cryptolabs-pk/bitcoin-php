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
 * Class NodeException
 * @package CryptoLabs\Bitcoin\Exceptions
 */
class NodeException extends \Exception
{
    /**
     * Sets Exception props (code, file and line), as if they were not passed to constructor
     * @param int|null $code
     * @param string|null $file
     * @param int|null $line
     * @return NodeException
     */
    public function set(?int $code = null, ?string $file = null, ?int $line = 0): self
    {
        if ($code) {
            $this->code = $code;
        }

        if ($file) {
            $this->file = $file;
            if ($line) {
                $this->line = $line;
            }
        }

        return $this;
    }
}