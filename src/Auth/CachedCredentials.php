<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

use DigitalCz\DigiSign\DigiSign;
use LogicException;
use Psr\SimpleCache\CacheInterface;

/**
 * Decorator to cache Credentials with PSR-16 CacheInterface
 */
final class CachedCredentials implements Credentials
{
    private const PREFIX = 'DGS_tok_';

    /** @var Credentials  */
    private $inner;

    /** @var CacheInterface  */
    private $cache;

    public function __construct(Credentials $inner, CacheInterface $cache)
    {
        if ($inner instanceof self) {
            throw new LogicException('Prevent double decoration');
        }

        $this->inner = $inner;
        $this->cache = $cache;
    }

    public function getHash(): string
    {
        return self::PREFIX . $this->inner->getHash();
    }

    public function provide(DigiSign $dgs): Token
    {
        $key = $this->getHash();

        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }

        $token = $this->inner->provide($dgs);

        $this->cache->set($key, $token, $token->getTtl());

        return $token;
    }

    public function getInner(): Credentials
    {
        return $this->inner;
    }
}
