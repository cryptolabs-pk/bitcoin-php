<?php
declare(strict_types=1);

namespace CryptoLabs\Bitcoin\Exceptions;

/**
 * Class BitcoinException
 * @package CryptoLabs\Bitcoin\Exceptions
 */
class BitcoinException extends \Exception
{
    /**
     * Sets Exception props (code, file and line), as if they were not passed to constructor
     * @param int|null $code
     * @param string|null $file
     * @param int|null $line
     * @return BitcoinException
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