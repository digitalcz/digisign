<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

use Psr\SimpleCache\CacheInterface;

final class CachingTokenProvider implements TokenProvider
{
    private const PREFIX = 'DGS_tok_';

    private TokenProvider $inner;
    private CacheInterface $cache;

    public function __construct(TokenProvider $inner, CacheInterface $cache)
    {
        $this->inner = $inner;
        $this->cache = $cache;
    }

    public function provide(Credentials $credentials): Token
    {
        $key = self::PREFIX . $credentials->getHash();

        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }

        $token = $this->inner->provide($credentials);

        $this->cache->set($key, $token, $token->getTtl());

        return $token;
    }
}
