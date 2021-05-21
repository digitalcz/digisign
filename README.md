# digisign

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![CI](https://github.com/digitalcz/digisign/workflows/CI/badge.svg)]()
[![codecov](https://codecov.io/gh/digitalcz/digisign/branch/master/graph/badge.svg)](https://codecov.io/gh/digitalcz/digisign)
[![Total Downloads][ico-downloads]][link-downloads]

Provides communication with www.digisign.cz in OOP PHP using PSR-18 HTTP Client, PSR-17 HTTP Factories and PSR-16 SimpleCache.

Documentation of API is here https://api.digisign.org/api/docs

## Install

Via [Composer](https://getcomposer.org/)

```bash
$ composer require digitalcz/digisign
```

## Configuration

#### Example configuration in PHP

```php
use DigitalCz\DigiSign\Auth\ApiKeyCredentials;
use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\DigiSignClient;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Psr16Cache;
use Symfony\Component\HttpClient\Psr18Client;

// Via constructor options
$dgs = new DigiSign([
    'access_key' => '...',
    'secret_key' => '...',

    // other options
    'cache' => new Psr16Cache(new FilesystemAdapter()), // or any other PSR16 implementation
    'http_client' => new Psr18Client(),                 // or any other PSR18 implementation
    'testing' => true                                   // use testing API base
]);

// Or via methods
$dgs = new DigiSign();
$dgs->setCredentials(new ApiKeyCredentials('...', '...'));
$dgs->setCache(new Psr16Cache(new FilesystemAdapter()));
$dgs->setClient(new DigiSignClient(new Psr18Client()));
$dgs->useTesting(true);
```

#### Example configuration in Symfony

```yaml
services:
    DigitalCz\DigiSign\DigiSign:
        $options:
            # minimal config
            access_key: '%digisign.accessKey%'
            secret_key: '%digisign.secretKey%'

            # other options
            cache: '@psr16.cache'
            http_client: '@psr18.http_client'
            testing: true # use testing API
```

## Usage

#### Create and send Envelope

```php
use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Stream\FileStream;

$dgs = new DigiSign(['access_key' => '...', 'secret_key' => '...']);

$envelopes = $dgs->envelopes();

$envelope = $envelopes->create([
    'emailSubject' => 'Please sign',
    'emailBody' => 'Hello James, please sign these documents.',
    'senderName' => 'John Smith',
    'senderEmail' => 'john.smith@example.com'
]);

$recipient = $envelopes->recipients($envelope)->create([
    'role' => 'signer',
    'name' => 'James Brown',
    'email' => 'james42@example.com',
    'mobile' => '+420775300500',
]);

$file = $dgs->files()->upload(FileStream::open('document.pdf'));

$document = $envelopes->documents($envelope)->create([
    'name' => 'Contract',
    'file' => $file->self()
]);

$envelopes->tags($envelope)->create([
    'type' => 'signature',
    'document' => $document,
    'recipient' => $recipient,
    'page' => 1,
    'xPosition' => 200,
    'yPosition' => 340
]);

$envelopes->send($envelope->id());
```

See [examples](examples) for more

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer csfix    # fix codestyle
$ composer checks   # run all checks 

# or separately
$ composer tests    # run phpunit
$ composer phpstan  # run phpstan
$ composer cs       # run codesniffer
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email devs@digital.cz instead of using the issue tracker.

## Credits

- [Digital Solutions s.r.o.][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/digitalcz/digisign.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/digitalcz/digisign.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/digitalcz/digisign
[link-downloads]: https://packagist.org/packages/digitalcz/digisign
[link-author]: https://github.com/digitalcz
[link-contributors]: ../../contributors
