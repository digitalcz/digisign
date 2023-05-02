<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopeRecipientsEndpoint
 */
class EnvelopeRecipientsEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/envelopes/bar/recipients');
    }

    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(self::endpoint()->block('foo'), '/api/envelopes/bar/recipients/foo/block');
        self::assertDefaultEndpointPath(
            self::endpoint()->attachments('foo'),
            '/api/envelopes/bar/recipients/foo/attachments',
        );
    }

    public function testCreateMany(): void
    {
        self::endpoint()->createMany(['foo' => 'bar']);
        self::assertLastRequest('PATCH', '/api/envelopes/bar/recipients', ['foo' => 'bar']);
    }

    public function testEmbed(): void
    {
        self::endpoint()->embed('foo', ['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/envelopes/bar/recipients/foo/embed', ['foo' => 'bar']);
    }

    public function testTags(): void
    {
        self::endpoint()->tags('foo', ['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/envelopes/bar/recipients/foo/tags?foo=bar');
    }

    public function testResend(): void
    {
        self::endpoint()->resend('foo');
        self::assertLastRequest('POST', '/api/envelopes/bar/recipients/foo/resend');
    }

    public function testVerifiedClaims(): void
    {
        self::endpoint()->verifiedClaims('foo');
        self::assertLastRequest('GET', '/api/envelopes/bar/recipients/foo/verified-claims');
    }

    public function testSigningOrder(): void
    {
        self::endpoint()->signingOrder(['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/envelopes/bar/recipients/signing-order');
    }

    public function testListAttachments(): void
    {
        self::endpoint()->listAttachments();
        self::assertLastRequest('GET', '/api/envelopes/bar/recipients/attachments');
    }

    public function testListIdentifications(): void
    {
        self::endpoint()->listIdentifications('foo');
        self::assertLastRequest('GET', '/api/envelopes/bar/recipients/foo/identifications');
    }

    public function testScenario(): void
    {
        self::endpoint()->scenario('foo');
        self::assertLastRequest('GET', '/api/envelopes/bar/recipients/foo/scenario');
    }

    protected static function endpoint(): EnvelopeRecipientsEndpoint
    {
        return self::dgs()->envelopes()->recipients('bar');
    }
}
