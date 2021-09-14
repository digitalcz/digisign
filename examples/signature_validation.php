<?php

declare(strict_types=1);

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Exception\InvalidSignatureException;

require dirname(__DIR__) . '/vendor/autoload.php';

// Get the "Signature" header from request
// it will look something like this
// t=1631618784,s=105fdbd04836782509cb37d4b379b6ec49e459419749db8abeed59226d55b60c
$header = $_SERVER['HTTP_SIGNATURE'] ?? ''; // @phpcs:ignore

// Get whole request body as string
$payload = file_get_contents('php://input');

// The Webhook secret that can be obtained when creating new Webhook
$secret = 'your-webhook-secret';

try {
    $dgs = new DigiSign();
    $dgs->validateSignature($payload, $header, $secret); // @phpstan-ignore-line

    echo "Signature is valid";
} catch (InvalidSignatureException $e) {
    echo "Signature is invalid: " . $e->getMessage();
}
