<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign;

use DigitalCz\DigiSign\Api\AccountApi;
use DigitalCz\DigiSign\Api\Delivery\DeliveryApi;
use DigitalCz\DigiSign\Api\Delivery\DeliveryDocumentApi;
use DigitalCz\DigiSign\Api\Delivery\DeliveryRecipientApi;
use DigitalCz\DigiSign\Api\Envelope\EnvelopeApi;
use DigitalCz\DigiSign\Api\Envelope\EnvelopeDocumentApi;
use DigitalCz\DigiSign\Api\Envelope\EnvelopeRecipientApi;
use DigitalCz\DigiSign\Api\Envelope\EnvelopeTagApi;
use DigitalCz\DigiSign\Api\FileApi;
use DigitalCz\DigiSign\Auth\AuthTokenProvider;
use DigitalCz\DigiSign\Dummy\Auth\InMemoryCache;
use PHPUnit\Framework\TestCase;

class DigiSignTest extends TestCase
{

    public function testConstruct(): void
    {
        $inMemoryCache = new InMemoryCache();
        $authTokenProvider = new AuthTokenProvider($inMemoryCache);

        $object = new DigiSign('YourAccessKey', 'YourSecretKey', $authTokenProvider);

        self::assertInstanceOf(AccountApi::class, $object->getAccountApi());
        self::assertInstanceOf(FileApi::class, $object->getFileApi());
        self::assertInstanceOf(DeliveryApi::class, $object->getDeliveryApi());
        self::assertInstanceOf(DeliveryDocumentApi::class, $object->getDeliveryDocumentApi());
        self::assertInstanceOf(DeliveryRecipientApi::class, $object->getDeliveryRecipientApi());
        self::assertInstanceOf(EnvelopeApi::class, $object->getEnvelopeApi());
        self::assertInstanceOf(EnvelopeDocumentApi::class, $object->getEnvelopeDocumentApi());
        self::assertInstanceOf(EnvelopeRecipientApi::class, $object->getEnvelopeRecipientApi());
        self::assertInstanceOf(EnvelopeTagApi::class, $object->getEnvelopeTagApi());
    }
}
