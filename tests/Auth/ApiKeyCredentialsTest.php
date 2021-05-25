<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\DigiSignClient;
use Http\Mock\Client;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\DigiSign\Auth\ApiKeyCredentials
 */
class ApiKeyCredentialsTest extends TestCase
{
    public function testHash(): void
    {
        $credentials = new ApiKeyCredentials('foo', 'bar');
        self::assertSame('3858f62230ac3c915f300c664312c63f', $credentials->getHash());
    }

    public function testProvide(): void
    {
        $mockClient = new Client();
        $mockClient->addResponse(new Response(200, [], '{"token": "moo","exp":123}'));

        $dgs = new DigiSign(['client' => new DigiSignClient($mockClient)]);

        $credentials = new ApiKeyCredentials('foo', 'bar');
        $token = $credentials->provide($dgs);

        self::assertEquals('{"accessKey":"foo","secretKey":"bar"}', (string)$mockClient->getLastRequest()->getBody());
        self::assertSame('moo', $token->getToken());
        self::assertSame(123, $token->getExp());
    }
}
