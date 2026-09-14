<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class Features extends BaseResource
{
    public bool $branding;
    public bool $brandingPlus;
    public bool $timestamps;
    public bool $timestampsAtsa;
    public bool $timestampsPostSignum;
    public bool $timestampsRenewal;
    public bool $fileCertificates;
    public bool $identify;
    public bool $identifyBankId;
    public bool $signatureScenarios;
    public bool $smsId;
    public bool $emailSender;
    public bool $identifyAi;
    public bool $batchSending;
    public bool $automaticTagsPlacement;
    public bool $bulkSigning;
    public bool $api;
    public string $bankIdProduct;
    public bool $bankIdSign;
    public bool $bankIdQSign;
    public bool $certificateAkv;
    public bool $certificateRemoteSign;
    public bool $inPersonSigning;
    public bool $advancedSettings;
    public bool $optionalSignature;
    public bool $textTag;
    public bool $checkboxTag;
    public bool $attachmentTag;
    public bool $dateOfSignatureTag;
    public bool $signingOrder;
    public bool $recipientRoleCc;
    public bool $recipientRoleApprover;
    public bool $smsNotifications;
    public bool $roleSettings;
    public bool $accountGroup;
    public bool $templateSharing;
    public bool $autosign;
}
