# Changelog

All notable changes will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## [Unreleased]
### Added
- Add `EnvelopeDocumentsEndpoint.merge`
- Add `EnvelopeTemplatesEndpoint.clone`
- Add `AccountMeEndpoint.update`
- Add `EnvelopeProperties` resource and `Envelope.properties`
- Add `EnvelopeTemplateTag.assignment` + `EnvelopeTemplateTag.EnvelopeRecipient` can be null
- Add `EnvelopeTag.assignment` + `EnvelopeTag.EnvelopeRecipient` can be null
- Add `EnvelopeTemplate.useDefaultTemplateSettings`
- Add `EnvelopeDocument.labelPositioning`, `EnvelopeDocument.labelPositionX`, `EnvelopeDocument.labelPositionY`, 
- Add `EnvelopeTemplateDocument.labelPositioning`, `EnvelopeTemplateDocument.labelPositionX`, `EnvelopeTemplateDocument.labelPositionY`, 
- Add `AccountSettings.bankIdSign`

## [1.4.0] - 2021-09-17
### Added
- Add `EnvelopeRecipient.intermediaryName` and `EnvelopeRecipient.intermediaryEmail`
- Add `EnvelopeTemplateRecipient.intermediaryName` and `EnvelopeTemplateRecipient.intermediaryEmail`
- Add `MyEnvelopeRecipient.intermediaryName` and `MyEnvelopeRecipient.intermediaryEmail`
- Add `AccountSecurity` endpoint and resource
- Add new method `DigiSign::validateSignature` for validation of webhook signatures

## [1.3.0] - 2021-09-03
### Added
- Add `EnvelopeTemplateDocument.positions` endpoint
- Add Suggest Contact EP `GET /api/my/contacts/suggest`
- Add `MyEnvelopeRecipient` authenticationMethod properties
- Add `EnvelopeDocument.fromTemplate`
- Add `EnvelopeRecipient.fromTemplate`
- Add `EnvelopeTag.fromTemplate`
- Add `MyEnvelope.senderEmail`
- Add `MyEnvelopeRecipient.signatureType`
- Add `EnvelopesEndpoint.template`
- Add `EnvelopesEndpoint.embedSigning`
- Add `EnvelopeTag.choice` and `EnvelopeTag.group`
- Add `EnvelopeTemplateTag.choice` and `EnvelopeTemplateTag.group`

### Modify
- Allow setting auth_bearer via options
- Add body param for `EnvelopesEndpoint.embedEdit`

## [1.2.0] - 2021-08-06
### Added
- Add `use` for `EnvelopeTemplateEndpoint`
- Add `AccountSettings.bankIdProduct`
- Add `EnvelopeTemplate.bankIdScopes`
- Add new `EnumsEndpoint`
- Add `EnvelopeTemplateDocumentsEndpoint::download`
- Add `EnvelopeTag.scale` and `EnvelopeTemplateTag.scale`
- Add multiple fields to `EnvelopeTemplateRecipient`
- Add `Envelope.template`
- Add new endpoints `MyEndpoint`, `MyDashboardEndpoint`, `MyEnvelopesEndpoint`
- Add new resources `MyDashboard`, `MyEnvelope`, `MyEnvelopeDocument` and `MyEnvelopeRecipient`
- Add new `MyAccount` endpoint and resource
- Add `MyAccountsEndpoint.accept` endpoint
- Add `MyAccountsEndpoint.decline` endpoint
- Add `MyAccount.status` property
- Add `AccountUsersEndpoint.reinvite` endpoint

### Modify
- Add `final` to all resources

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
