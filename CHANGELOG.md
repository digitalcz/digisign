# Changelog

All notable changes will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## [1.1.0] - 2021-06-25
### Added
- Add PHP 7.2 compatibility
- Add `EnvelopeTag.width`
- Add `EnvelopeTag.bankIdClaim`
- Add `Envelope.sendCompleted`
- Add `Envelope.timestampDocuments`
- Add `EnvelopeTemplate.sendCompleted`
- Add `EnvelopeTemplate.timestampDocuments`
- Add `resend` for `EnvelopesEndpoint`
- Add new `EnvelopeTemplate` endpoints and resources 

## [1.0.2] - 2021-06-09
### Added
- Add new `WebhookAttemptsEndpoint` and `WebhookAttempt` resource

### Modify
- Add `Webhook.status`
- Add `Webhook.secret`

### Fixed
- Fix caching resolved mapping without subclass

## [1.0.1] - 2021-06-03
### Fixed
- Fix nullable types on EnvelopeTag

## [1.0.0] - 2021-05-25
Complete rewrite of library

see [UPGRADING-1.0](UPGRADING-1.0.md)

## [0.1.3] - 2020-11-09
### Added
- Add support of API EnvelopeNotification
- Add more tests for increase code coverage

## [0.1.2] - 2020-11-03
### Fixed
- Fix RuntimeException Message Body

## [0.1.1] - 2020-10-23
### Fixed
- Fixed UriResolver URI to https://api.digisign.org

## [0.1.0] - 2020-10-16
### Added
- Add support of API Envelope, EnvelopeDocument, EnvelopeRecipient, EnvelopeTag
- Add support of API Delivery, DeliveryDocument, DeliveryRecipient
- Add support of API File, Account
- Add AuthProvider with AuthTokenProviderInterface
- Add new IriTemplate and Iri classes to improve work with IRIs
- Add more implementations of Iri, Add abstract ResourceIri to simplify Iri classes
- Add more tests for increase code coverage

