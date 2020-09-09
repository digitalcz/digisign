<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

use DigitalCz\DigiSign\Model\Credentials;
use DigitalCz\DigiSign\Model\ValueObject\AuthToken;
use Psr\SimpleCache\CacheInterface;

class AuthTokenProvider implements AuthTokenProviderInterface
{

    /**
     * @var CacheInterface
     */
    protected $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function getAccessToken(Credentials $credentials): ?AuthToken
    {
        $authToken = $this->cache->get($credentials->getAccessKey());

        if ($authToken === null) {
            return null;
        }

        return AuthToken::fromArray($authToken);
    }

    public function setAccessToken(Credentials $credentials, AuthToken $authToken): void
    {
        $this->cache->set($credentials->getAccessKey(), $authToken->toArray(), $authToken->getTtl());
    }
}
