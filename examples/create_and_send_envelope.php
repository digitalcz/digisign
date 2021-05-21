<?php

declare(strict_types=1);

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Stream\FileStream;

require dirname(__DIR__) . '/vendor/autoload.php';

$dgs = new DigiSign([
    'access_key' => '...',
    'secret_key' => '...',
]);

$envelopes = $dgs->envelopes();

$envelope = $envelopes->create([
    'emailSubject' => 'Please sign',
    'emailBody' => 'Hello James, please sign these documents.',
    'senderName' => 'John Smith',
    'senderEmail' => 'john.smith@example.com',
]);
echo "Created Envelope " . $envelope->self() . PHP_EOL;

$recipient = $envelopes->recipients($envelope)->create([
    'role' => 'signer',
    'name' => 'James Brown',
    'email' => 'james42@example.com',
    'mobile' => '+420775300500',
]);
echo "Added EnvelopeRecipient " . $recipient->self() . PHP_EOL;

$file = $dgs->files()->upload(FileStream::open(__DIR__ . '/dummy.pdf'));
echo "Uploaded File " . $file->self() . PHP_EOL;

$document = $envelopes->documents($envelope)->create([
    'name' => 'Contract',
    'file' => $file, // resources in body must be referenced via IRI or you can use Resource instance
]);
echo "Added EnvelopeDocument " . $document->self() . PHP_EOL;

$tag = $envelopes->tags($envelope)->create([
    'type' => 'signature',
    'document' => $document,
    'recipient' => $recipient,
    'page' => 1,
    'xPosition' => 200,
    'yPosition' => 340,
]);
echo "Added SignatureTag " . $tag->self() . PHP_EOL;

$envelopes->send($envelope->id());

echo "Envelope sent" . PHP_EOL;
dump($envelopes->get($envelope->id())->toArray());
