<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

use DigitalCz\DigiSign\Dummy\Auth\InMemoryCache;
use DigitalCz\DigiSign\ValueObject\Request\Credentials;
use DigitalCz\DigiSign\ValueObject\Response\AuthToken;
use PHPUnit\Framework\TestCase;

class AuthTokenProviderTest extends TestCase
{
    public function testNotAccessTokenInCache(): void
    {
        $credentials = new Credentials('clientId', 'clientSecret');

        $provider = new AuthTokenProvider(new InMemoryCache());

        $this->assertEquals(null, $provider->getAccessToken($credentials));
    }

    public function testAccessTokenICache(): void
    {
        $credentials = new Credentials('clientId', 'clientSecret');

        $cache = new InMemoryCache();
        $provider = new AuthTokenProvider($cache);

        $contents = file_get_contents(__DIR__ . '/../Dummy/Responses/auth_token.json');
        $data = json_decode($contents !== false ? $contents : '', true);
        $token = AuthToken::fromArray($data);

        $cache->set('clientId', $data);

        $this->assertEquals($token, $provider->getAccessToken($credentials));
    }

    public function testSetAccessTokenToCache(): void
    {
        $credentials = new Credentials('clientId', 'clientSecret');

        $cache = new InMemoryCache();
        $provider = new AuthTokenProvider($cache);

        $contents = file_get_contents(__DIR__ . '/../Dummy/Responses/auth_token.json');
        $data = json_decode($contents !== false ? $contents : '', true);
        $token = AuthToken::fromArray($data);

        $provider->setAccessToken($credentials, $token);

        $this->assertEquals($data, $cache->get($credentials->getAccessKey()));

        $tokenFromCache = $provider->getAccessToken($credentials);

        $this->assertEquals($tokenFromCache, $token);
    }
}
