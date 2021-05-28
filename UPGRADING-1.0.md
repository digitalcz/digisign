Upgrading From 0.x To 1.x
=========================

**Version 1 is major rewrite of the library.**

It aimed to ease configuration and usage and to improve forward compatibility with changes implemented on the DigiSign API.

* ### Initialization of DigiSign object
  The constructor of DigiSign object now accepts array of options

  Before:
    ```php
    $psr6Cache = new Symfony\Component\Cache\Adapter\FilesystemAdapter();
    $psr16Cache = new Symfony\Component\Cache\Psr16Cache($psr6Cache);
  
    $tokenProvider = new DigitalCz\DigiSign\Auth\AuthTokenProvider($psr16Cache);
    $dgs = new DigitalCz\DigiSign\DigiSign(
        'yourAccessKey',
        'yourSecretKey',
        $tokenProvider,
        new Symfony\Component\HttpClient\Psr18Client(),
        null, // request factory
        null, // stream factory
        true, // sandbox
    );
    ```

  After:
    ```php
    $psr6Cache = new Symfony\Component\Cache\Adapter\FilesystemAdapter();
    $psr16Cache = new Symfony\Component\Cache\Psr16Cache($psr6Cache);
  
    $dgs = new DigitalCz\DigiSign\DigiSign([
        'access_key' => '...',
        'secret_key' => '...',
        'cache' => $psr16Cache,
        'http_client' => new Symfony\Component\HttpClient\Psr18Client(),
        'testing' => true, // formerly sandbox
    ]);
    ```

* ### Creating Envelope
  Request body is no longer DTO but just array, so that partial updates are possible

  Before:
    ```php 
    $envelope = new DigitalCz\DigiSign\Model\DTO\EnvelopeData(
        'Document to sign',
        'Hi James,<br/>please sign document.<br/>Thank you.<br/>Anna',
        'Anna',
        'anna@example.com',
        new DateTimeImmutable('2022-09-21T09:45:29+02:00'),
        'your-app-id'
    );
    
    $envelope = $dgs->getEnvelopeApi()->createEnvelope($envelope);
    ```
  
  After:
    ```php
    $envelope = $dgs->envelopes()->create([
        'emailSubject' => 'Document to sign',
        'emailBody' => 'Hi James,<br/>please sign document.<br/>Thank you.<br/>Anna',
        'senderName' => 'John Smith',
        'senderEmail' => 'john.smith@example.com',
        'validTo' => new DateTimeImmutable('2022-09-21T09:45:29+02:00'),
        'metadata' => 'your-app-id'
    ]);
    ```

* ### Accessing data
  ValueObjects were replaced with Resource objects that have public properties, and simple serialization logic. Resource objects also carry instance of the Response from API
  
  Before:
    ```php 
    $envelope = $dgs->getEnvelopeApi()->getEnvelope('9181d626-5c99-49d7-ba86-2410e98f6433');
    $envelopeId = $envelope->getId(); // '9181d626-5c99-49d7-ba86-2410e98f6433'
    $status = $envelope->getStatus(); // 'draft'
    ```

  After:
    ```php
    $envelope = $dgs->envelopes()->get('9181d626-5c99-49d7-ba86-2410e98f6433');
    $envelopeId = $envelope->id; // '9181d626-5c99-49d7-ba86-2410e98f6433'
    $status = $envelope->status; // 'draft'
    $envelope->getResponse(); // access the Response
    ```

* ### Working with files
  Before:
    ```php
    // uploading
    $file = DigitalCz\DigiSign\Model\Stream::fromPath('path/to/file.pdf');
    $dgs->getFileApi()->createFile($file);
  
    // downloading
    $file = $dgs->getEnvelopeApi()->downloadEnvelope('9181d626-5c99-49d7-ba86-2410e98f6433');
    file_put_contents('path/to/file.pdf', $file->getStream()->getHandle());
    ```
  
  After:
    ```php
    // uploading
    $file = DigitalCz\DigiSign\Stream\FileStream::open('path/to/file.pdf');
    $dgs->files()->upload($file);
  
    // downloading
    $file = $dgs->envelopes()->download('9181d626-5c99-49d7-ba86-2410e98f6433');
    $file->save('path/to/file.pdf');
    ```
