<?php
declare(strict_types=1);

namespace CryptoLabs\Bitcoin\Exceptions;

/**
 * Class InvalidTypeException
 * @package CryptoLabs\Bitcoin\Exceptions
 */
class InvalidTypeException extends BitcoinException
{
    /**
     * @param string $param
     * @param string|null $excepted
     * @param string|null $got
     * @return InvalidTypeException
     */
    public static function Param(string $param, ?string $excepted = null, ?string $got = null): self
    {
        $message = sprintf('Invalid value for param "%s"', $param);
        if ($excepted) {
            $message .= sprintf(', expected "%s"', $excepted);
        }

        if ($got) {
            $message .= sprintf(', got "%s"', $got);
        }

        return new self($message);
    }
}