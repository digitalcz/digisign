<?php

declare(strict_types=1);

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Exception\BadRequestException;

require dirname(__DIR__) . '/vendor/autoload.php';

$dgs = new DigiSign([
    'access_key' => '...',
    'secret_key' => '...',
]);

try {
    $dgs->account()->settings()->update([
        'defaultSenderEmail' => 'invalid-email',
        'shortName' => 'ab',
    ]);
} catch (BadRequestException $e) {
    $violations = $e->getViolations();

    if ($violations === null) {
        echo "No violations";
    } else {
        dump($violations->toArray());
    }
}
