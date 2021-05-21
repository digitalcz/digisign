<?php

declare(strict_types=1);

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Resource\Envelope;

require dirname(__DIR__) . '/vendor/autoload.php';

$dgs = new DigiSign([
    'access_key' => '...',
    'secret_key' => '...',
]);

$list = $dgs->envelopes()->list([
    'status' => ['in' => ['draft', 'sent']],    // filter status "draft" or "sent"
    'order' => ['createdAt' => 'DESC'],         // order by createdAt descending
    'itemsPerPage' => 30,                       // limit items returned in request
    'page' => 1,                                // the page
]);

// Print envelopes ID, subject and status

/** @var Envelope $envelope */
foreach ($list->items as $envelope) {
    echo sprintf('%s - %s [%s]' . PHP_EOL, $envelope->id, $envelope->emailSubject, $envelope->status);
}
