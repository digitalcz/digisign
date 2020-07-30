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
