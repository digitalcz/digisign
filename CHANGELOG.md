# Changelog

All notable changes will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## [Unreleased]
- Add `MyEndpoint.updatePreferences` endpoint and `MyPreferences` resource
- Add `SignatureScenarioVersionInfo.role`
- Add `BatchSendingsEndpoint.send` endpoint
- Add `BatchSendingsEndpoint.list` endpoint
- Add `AccountSecurity.visibleAutosignRoleOption` in to resource
- Add `AccountSecurity.visibleNoneSignerChannelOption` in to resource
- Add `AccountSecurity.hasCustomCertificate` in to resource
- Add `BatchSendingsEndpoint.stats` endpoint
- Extend `BatchSending` and `BatchSendingItem` resource
- Edit `BatchSending` resource with envelopeTemplate
- Extend `BatchSendingStats` resource with deleted
- Add `AccountBilling.cancelAt`
- Add `AccountEndpoint.createDefaultSubscription` endpoint
- Add `SignatureScenario.latestVersionInfo`

## [2.5.0] - 2024-10-14
- Add `AccountBilling.automaticTagsPlacement`
- Add `AccountBilling.batchSending`
- Extend `EnvelopeRecipient` and `EnvelopeTemplateRecipient` resource
- Add `EnvelopeDocument.createTagsByAutoplacement` endpoint
- Add `Webhook oAuth properties`
- Add `ForbiddenException`
- Add `AccountBilling.productType`
- Add `EnvelopeTemplate.title`
- Add `EnvelopesEndpoint.cancel` body
- Fix `AccountUsersEndpoint.invite` endpoint
- Add `MyIdentifications.info` endpoint
- Add `EnvelopeRecipient.certificateInfo` endpoint
- Add `EnvelopeProperties.channelForSender` in to resource
- Edit `CertificateInfo` resource
- Extend `Contact` resource
- Extend `AccountBilling` resource with identify limits
- Add `AccountBilling.userContactLimit`
- Add `IdentifyScenarioVersion.restrictedCountries`
- Add `EnvelopeTemplateDocumentAssignments` endpoint
- Add `Envelope.createdBy` and `Envelope.sentBy`
- Add `BatchSendings` and `BatchSendingsItems` endpoints and resources
- Add `AccountSecurity.localSignature` to resource

## [2.4.0] - 2024-05-14
### Added
- Add `EnvelopeTemplateRecipientDefaults.signDocumentsAtOnce`
- Add `AccountSecurity.signDocumentsAtOnce`
- Add `EnvelopeRecipient.signDocumentsAtOnce`
- Add `EnvelopeTemplateRecipient.signDocumentsAtOnce`
- Add `EnvelopeDocumentsEndpoint.invalidate`
- Add `EnvelopeDocumentsEndpoint.restore`
- Add `CompletedIdentificationReport.name`
- Add `ReportEndpoint.completedIdentifications` endpoint and `CompletedIdentificationReport` resource
- Add `IdentificationResult` claims
- Add `IdentificationsEndpoint.updateResult`
- Add `SignatureScenarioVariant.signDocumentsAtOnce`
- Add `EnvelopeTagsEndpoint.updateValues` endpoint
- Add `EnvelopeDocument.assignments` to resource
- Add `EnvelopeRecipient` signed document columns
- Add `EnvelopeTagsByPlaceholder` endpoint

## [2.3.0] - 2024-03-28
### Added
- Add `SentEnvelopeReport.bankIdSignCount`
- Add `SentEnvelopeReport.bankIdIdentifyAmlCount`
- Add `IdentificationEndpoint.delete`
- Add `IdentifyScenarioVersion.expireAfterHours`
- Add `IdentifyScenarioVersion.discardCompletedAfterDays`
- Add AccountSecurity.discardedIdentificationRetention
- Add multiple Identifications endpoints
- Add `IdentificationInspection.claims`
- Add `Identificaiton.cancelledAt`
- Add `Identificaiton.discardedAt`
- Add `Identification.result` and its sub-entities
- Add `IdentificationsEndpoint.cancel`
- Add `IdentificationsEndpoint.discard`
- Add `IdentificationsEndpoint.restore`
- Add `Identification.forReviewAt`
- Add `EnvelopeRecipient.channelForNotifications`
- Add `EnvelopeTemplateRecipient.channelForNotifications`
- Add `DeactivateAccount` endpoint
- Add `MyAccount.idpAlias`
- Add `IdentifyScenarioInfo.approvalMode`
- Add `Envelope.name`

### Deprecated
- Deprecate `Envelope.emailSubject`

## [2.2.0] - 2023-12-18
### Added
- Add `SentEnvelopeReport.sender`
- Add `IdentifyScenarioVersion.selfieEnabled`
- Add `AccountBilling.identifyAi`
- Add `MyAccount.createdAt`
- Add `MyContactsEndpoint` CRUD endpoints
- Add `IdentifyScenarioVersion.ownConditions`
- Add `MyAccount.shortName`
- Add `MyEndpoint.info` endpoint and `MyInfo` resource
- Add `MyAccountEndpoint.switch` endpoint
- Add `AccountSmsSendersEndpoint` and `AccountSmsSender` resource
- Add `envelopeAnonymizeRetention` and `envelopeAnonymizeGroups` to `AccountSecurity`
- Add `anonymizeAt` and `anonymizedAt` to `Envelope`
- Add anonymize action to `Envelope`
- Add `AccountEmailSendersEndpoint` and `AccountEmailSender` resource
- Add `approvedAt`, `deniedAt` and `denailMessage` to `Identification`
- Add `Identification.approve` endpoint and `Identification.deny` endpoint
- Add `notificationForSenderEmail` to `AccountSettings`
- Add `EnvelopeTag.format`, `EnvelopeTag.dateOfSignature`, `EnvelopeTemplateTag.format`
- Add `ScenarioVersionInfo` to `Identification`
- Add `EnvelopeTemplate.visibleFields`, `EnvelopeTemplate.validatedFields`, `EnvelopeTemplate.delegation`
- Add `EnvelopeTemplate.signerDefaults`, `EnvelopeTemplate.approverDefaults`, `EnvelopeTemplate.ccDefaults`
- Add `EnvelopeTemplateRecipientDefaults`

### Changed
- Change `EnvelopeDocument.file` to nullable
- Change `EnvelopeRecipientAttachment.file` to nullable

## [2.1.0] - 2023-07-12
### Added
- Add `AccountSecurity.auditLogDownloadDefaultUnchecked`
- Add `AccountSettings.documentsMerging`
- Add `MyEnvelope.subjectName`
- Add `MyEnvelope.validTo`
- Add `AccountIdentifyScenariosEndpoint` and `IdentifyScenario` resource
- Add `AccountIdentifyScenarioVersionsEndpoint` and `IdentifyScenarioVersion` resource
- Add `AccountSettings.identify`
- Add multiple fields for `IdentifyScenarioVersion`
- Add `IdentifyScenariosEndpoint.info` endpoint
- Add `SignatureScenariosEndpoint.info` endpoint
- Add scenario fields on `EnvelopeRecipient` and `EnvelopeTemplateRecipient` and `EnvelopeTemplate`
- Modify and add various `SignatureScenarioVariant` fields
- Add `IdentificationScenarioVersion.approvalMode`
- Add `IdentificationInfo` resource and `EnvelopeRecipient.identification`
- Add `EnvelopeProperties.auditLogAvailableToAccountUsers`
- Add `IdentificationInfo.approvalMode`
- Add `EnvelopeRecipient.approvalMode`
- Add `EnvelopeRecipient.approveDocumentsAtOnce`
- Add `EnvelopeTemplateRecipient.approvalMode`
- Add `EnvelopeTemplateRecipient.approveDocumentsAtOnce`

### Changed
- Change `Identification.envelope` from string to EnvelopeInfo

### Fixed
- Fix `MyEnelopeRecipient.intermediaryName` and `MyEnvelopeRecipient.intermediaryEmail` type as nullable

## [2.0.0] - 2023-05-09
### Added
- Add `EnvelopeRecipientIdentification.authorizedAt`
- Add resource `Blame`
- Add `Envelope.sender`
- Add `Branding.signerReturnUrl`
- Add `AccountEndpoint.manageBilling`
- Add multiple fields for `AccountBilling`
- Add identify field for `AccountBilling`
- Add `IdentificationsEndpoint` and `Identification` resource
- Add `AccountSignatureScenariosEndpoint` and `SignatureScenario` resource
- Add `AccountSignatureScenarioVersionsEndpoint`, `SignatureScenarioVersion` and `SignatureScenarioVariant` resource
- Add `AccountSettings.signatureScenarios`
- Add `AccountBilling.signatureScenarios`
- Add `Account.sentWithSignatureScenarios`
- Add `EnvelopeRecipientsEndpoint.scenario` endpoint

### Fixed
- Fix nullable type on `MyAccount.idpDomain`
- Fix nullable type on `Branding.ownConditions`
- Fix nullable type on `EnvelopeTemplateRecipient.intermediaryName`
- Fix incorrect type on `EnvelopeTemplateTag.document` and `EnvelopeTemlateTag.recipient`
- Fix incorrect type on `AccountRequest.createdBy`
- Fix incorrect type on `Certificate.expiresAt`

### Changed
- Added native types to all properties
- Replaced usage of dynamic properties with magic methods

### Removed
- Removed support for older PHP versions (<8.0)

## [1.12.0] - 2022-12-14
### Added
- Add new fields for IdentityProvider
- Add new field $userId for User
- Add new field $signatureValidity for EnvelopeDocument
- Add new field $height for EnvelopeTag and EnvelopeTemplateTag
- Add `EnvelopeTag.recipientClaim`, `EnvelopeTemplateTag.recipientClaim`
- Add new fields $identificationNumber, $address for `EnvelopeRecipient` and `EnvelopeTemplateRecipient`
- Add signatureImageContent endpoint to AccountMe 
- Add new field $hasSignatureImage to User
- Add method BaseResource::links() that returns links

### Fixed
- Remove invalid fields on ListResource + fix tests

## [1.11.0]
### Added
- Add new oidc fields for `AccountSecurity` resource
- Add `Certificate.vaultName`, `Certificate.certificateName`
- Add `EnvelopeProperties.sendDocumentsAsEmailAttachment`
- Add `EnvelopeProperties.generateSignatureSheet`
- Add `EnvelopeProperties.auditLogAvailableToAllRecipients`
- Add `EnvelopeRecipient.authFailedReason`
- Update `EnvelopesEndpoint.discard` with body like discardAt param
- Add new `EnvelopeDocumentSignatureSheets` resource and endpoint
- Add my envelope info endpoint
- Add `AccountSettings.useEnvelopeDescription`, `Envelope.description` and `EnvelopeTemplate.description`
- Add `User.autoscrollTags`
- Add `AccountSecurity.discardedEnvelopeRetention`
- Add `EnvelopeProperties.timestampDocuments`, `EnvelopeProperties.timestampAuditlog`, `EnvelopeProperties.timestampingAuthorities`, `EnvelopeProperties.sendCompleted`
- Add `AccountSecurity.continuousSigning`

## [1.10.0]
### Added
- Add `EnvelopeDocumentAssignmentsEndpoint`
- Add `AccountBrandings` CRUD endpoint
- Add `Envelope.branding` and `EnvelopeTemplate.branding`
- Add multiple fields for `Branding`
- Add new `AccountMessaging` endpoint and resource
- Add `Branding.ownConditions`
- Add multiple fields for `AccountSettings`
- Add new endpoint `EnvelopeRecipientEndpoint.listIdentifications`

### Modified
- Update VerifiedClaims resource

## [1.9.0]
### Added
- Add `AccountRequest.requestTime|responseTime|duration`
- Add `EnvelopeTag.renderInteractive` and `EnvelopeTemplateTag.renderInteractive`
- Add new fields for `AccountStatistics` and `AccountSmsLog`
- Add `EnvelopeEndpoint.startCorrection` and `EnvelopeEndpoint.finishCorrection`

## [1.8.0]
### Added
- Add `EnvelopeRecipientTemplate.bankIdScopes`
- Add emailBodyCompleted to four resources
- Add `ReportEndpoint.sentEnvelopes`
- Add `EnvelopeDocumentsEndpoint.replaceFile`
- Add `EnvelopeTemplateDocumentsEndpoint.replaceFile`
- Add `EnvelopeProperties.labelPositioning`
- Add `Envelope.sealedAt`

### Fixed
- Fix hydration of nullable properties

### Changed
- Change EnvelopeTemplateDocument.labelPositioning as not nullable

## [1.7.0]
### Added
- Add `AccountCertificateEndpoint` and `Certificate` resource
- Add `Label` resource and `LabelsEndpoint`
- Add `EnvelopeLabelsEndpoint`
- Add `EnvelopeRecipient.bankIdScopes`
- Add `AccountCertificatesEndpoint.enable` and `AccountCertificatesEndpoint.disable`
- Add `EnvelopeTemplateLabelsEndpoint`
- Add `EnvelopeEndpoint.discard` and `EnvelopeEndpoint.restore`
- Add `EnvelopeProperties.signatureTagParts`
- Add `EnvelopesEndpoint.validate`

### Changed
- Replace fields `authenticationMethod`, `authenticationPlace` and `authenticateOnDownload` with `authenticationOnOpen`, `authenticationOnSignature` and `authenticationOnDownload`
- Remove `AccountEnvelopeTemplate`, leave only `EnvelopeTemplate`

## [1.6.0] - 2021-11-26
### Added
- Add `MyAccountsEndpoint.get` and `MyAccount.idpDomain`
- Add `IdentityProvider` resource and `Account.identityProvider`
- Add `EnvelopesEndpoint.clone`
- Add `EnvelopeProperties.declineAllowed` and `EnvelopeProperties.declineReasonRequired`
- Add `EnvelopeRecipient.declineReason`
- Add `EnvelopeRecipientAttachment` resource
- Add `EnvelopeRecipientEndpoint.attachments`
- Add `EnvelopeRecipientAttachmentsEndpoint`

## [1.5.0] - 2021-11-09
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
