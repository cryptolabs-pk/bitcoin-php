<?php
declare(strict_types=1);

namespace CryptoLabs\Bitcoin\Wallets;

use CryptoLabs\Bitcoin\Exceptions\Wallets\PrivateKeyConstructException;
use CryptoLabs\Bitcoin\Node;
use CryptoLabs\DataTypes\Base16;

/**
 * Class PrivateKey
 * @package CryptoLabs\Bitcoin\Wallets
 */
class PrivateKey
{
    /** @var Node */
    private $node;
    /** @var Base16 */
    private $privateKey;
    /** @var null|PublicKey */
    private $publicKey;

    /**
     * @param string $hexits
     * @param Node $node
     * @return PrivateKey
     * @throws PrivateKeyConstructException
     */
    public static function Entropy(string $hexits, Node $node): self
    {
        if (!preg_match('/^[a-f0-9]+$/i', $hexits)) {
            throw PrivateKeyConstructException::EncodingException();
        }

        return new self($node, Base16::Decode($hexits));
    }

    /**
     * PrivateKey constructor.
     * @param Node $node
     * @param Base16 $privateKey
     * @throws PrivateKeyConstructException
     */
    public function __construct(Node $node, Base16 $privateKey)
    {
        if ($privateKey->size()->bits() !== 256) {
            throw PrivateKeyConstructException::LengthException();
        }

        $this->node = $node;
        $this->privateKey = $privateKey;
    }

    /**
     * @return array
     */
    public function __debugInfo()
    {
        return [sprintf('%s Private Key', $this->node->network()->name())];
    }

    public function publicKey(): PublicKey
    {

    }
}