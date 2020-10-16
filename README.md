# digisign

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![CI](https://github.com/digitalcz/digisign/workflows/CI/badge.svg)]()
[![codecov](https://codecov.io/gh/digitalcz/digisign/branch/master/graph/badge.svg)](https://codecov.io/gh/digitalcz/digisign)
[![Total Downloads][ico-downloads]][link-downloads]

Provides communication with digisign.org (see https://digisign.org/api) in PHP via PSR-18 http client. 
Implemented standards PSR18 http client, PSR17 Discovery and PSR16 cache.

## Install

Via Composer

```bash
$ composer require digitalcz/digisign
```

## Configuration

#### Example of configuration in Symfony

```yaml
services:
    _defaults:
        autowire: true
        autoconfigure: true

    document_signature_cache_provider:
        class: Symfony\Component\Cache\Simple\DoctrineCache
        arguments: ['@doctrine_cache.document_signature']

    DigitalCz\DigiSign\Auth\AuthTokenProvider:
        arguments:
            - '@document_signature_cache_provider'

    DigitalCz\DigiSign\Auth\AuthTokenProviderInterface: '@DigitalCz\DigiSign\Auth\AuthTokenProvider'

    DigitalCz\DigiSign\DigiSign:
        arguments:
            $clientId: '%digisign.accessKey%'
            $clientSecret: '%digisign.secretKey%'
            $sandbox: '%digisign.sandbox%'

    Infrastructure\DocumentSignature\DigiSign\DigiSignAdapter:
        arguments: ['@DigitalCz\DigiSign\DigiSign']
```

## Usage

#### Example of usage in PHP

```php
// create PSR6 and PSR16 cache
$psr6Cache = new Symfony\Component\Cache\Adapter\FilesystemAdapter();
$psr16Cache = new Symfony\Component\Cache\Psr16Cache($psr6Cache);

// create auth token provider
$tokenProvider = new DigitalCz\DigiSign\Auth\AuthTokenProvider($psr16Cache);

$digiSign = new DigitalCz\DigiSign\DigiSign(
    'yourAccessKey',
    'yourSecretKey',
    $tokenProvider
);

// create envelope DTO
$envelope = new DigitalCz\DigiSign\Model\DTO\EnvelopeData(
    'Document to sign',
    'Hi James,<br/>please sign document.<br/>Thank you.<br/>Anna',
    'Anna',
    'anna@example.com',
    new DateTimeImmutable('2022-09-21T09:45:29+02:00'),
    'your-app-id'
);

// send envelope DTO via DigiSign API
$envelope = $digiSign->getEnvelopeApi()->createEnvelope($envelope);

// get envelope data from api response converted to value object
$envelopeId = $envelope->getId();
$status = $envelope->getStatus();
...
```

#### Token Provider
You can use AuthTokenProvider which use PSR6 CachingInterface (see https://www.php-fig.org/psr/psr-6/) 
for automatically store token. Or you can implement your own with AccessTokenProviderInterface.


## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer tests
$ composer phpstan
$ composer cs       # codesniffer
$ composer csfix    # code beautifier
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
