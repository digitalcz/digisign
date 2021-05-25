<?php

declare(strict_types=1);

use DigitalCz\DigiSign\DigiSign;

require dirname(__DIR__) . '/vendor/autoload.php';

$dgs = new DigiSign([
    'access_key' => '...',
    'secret_key' => '...',
]);

$envelopeId = '...';
$documentId = '...';

// Download single EnvelopeDocument and save as document.pdf
$fileResponse = $dgs->envelopes()->documents($envelopeId)->download($documentId);
$fileResponse->save(__DIR__ . '/document.pdf');
echo 'Document saved as ' . __DIR__ . '/document.pdf' . PHP_EOL;

// Download Envelope documents as ZIP and save in directory
$fileResponse = $dgs->envelopes()->download($envelopeId, ['output' => 'separate']);
$fileResponse->save(__DIR__);
echo 'Envelope ZIP saved as ' . __DIR__ . $fileResponse->getFile()->getFilename() . PHP_EOL;

// Download audit_log and use handle to save the file manually
$fileResponse = $dgs->envelopes()->download($envelopeId, ['output' => 'only_log']);
$fileHandle = $fileResponse->getFile()->getHandle();
file_put_contents(__DIR__ . 'audit_log.pdf', $fileHandle);
echo 'Audit log saved as' . __DIR__ . 'audit_log.pdf' . PHP_EOL;
