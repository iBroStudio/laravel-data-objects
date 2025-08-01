<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Casts\DtoValueObjetCastTransformer;
use IBroStudio\DataObjects\ValueObjects;

return [
    'dto' => [
        'casts' => [
            ValueObjects\Text::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Boolean::class => DtoValueObjetCastTransformer::class,
            ValueObjects\ClassString::class => DtoValueObjetCastTransformer::class,
            ValueObjects\CompanyName::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Domain::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Email::class => DtoValueObjetCastTransformer::class,
            ValueObjects\EncryptableText::class => DtoValueObjetCastTransformer::class,
            ValueObjects\FirstName::class => DtoValueObjetCastTransformer::class,
            ValueObjects\FloatValueObject::class => DtoValueObjetCastTransformer::class,
            ValueObjects\FullName::class => DtoValueObjetCastTransformer::class,
            ValueObjects\GitSshUrl::class => DtoValueObjetCastTransformer::class,
            ValueObjects\HashedPassword::class => DtoValueObjetCastTransformer::class,
            ValueObjects\IntegerValueObject::class => DtoValueObjetCastTransformer::class,
            ValueObjects\IpAddress::class => DtoValueObjetCastTransformer::class,
            ValueObjects\LastName::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Name::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Phone::class => DtoValueObjetCastTransformer::class,
            ValueObjects\SemanticVersion::class => DtoValueObjetCastTransformer::class,
            ValueObjects\SshKey::class => DtoValueObjetCastTransformer::class,
            ValueObjects\TempFolder::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Timecode::class => DtoValueObjetCastTransformer::class,
            ValueObjects\TimeDuration::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Url::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Uuid::class => DtoValueObjetCastTransformer::class,
            ValueObjects\VatNumber::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Authentication\BasicAuthentication::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Authentication\S3Authentication::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Authentication\SshAuthentication::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Authentication\AuthenticationAbstract::class => DtoValueObjetCastTransformer::class,
        ],

        'transformers' => [
            ValueObjects\Text::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Boolean::class => DtoValueObjetCastTransformer::class,
            ValueObjects\ClassString::class => DtoValueObjetCastTransformer::class,
            ValueObjects\CompanyName::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Domain::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Email::class => DtoValueObjetCastTransformer::class,
            ValueObjects\EncryptableText::class => DtoValueObjetCastTransformer::class,
            ValueObjects\FirstName::class => DtoValueObjetCastTransformer::class,
            ValueObjects\FloatValueObject::class => DtoValueObjetCastTransformer::class,
            ValueObjects\FullName::class => DtoValueObjetCastTransformer::class,
            ValueObjects\GitSshUrl::class => DtoValueObjetCastTransformer::class,
            ValueObjects\HashedPassword::class => DtoValueObjetCastTransformer::class,
            ValueObjects\IntegerValueObject::class => DtoValueObjetCastTransformer::class,
            ValueObjects\IpAddress::class => DtoValueObjetCastTransformer::class,
            ValueObjects\LastName::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Name::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Phone::class => DtoValueObjetCastTransformer::class,
            ValueObjects\SemanticVersion::class => DtoValueObjetCastTransformer::class,
            ValueObjects\TempFolder::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Timecode::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Url::class => DtoValueObjetCastTransformer::class,
            ValueObjects\Uuid::class => DtoValueObjetCastTransformer::class,
            ValueObjects\VatNumber::class => DtoValueObjetCastTransformer::class,
        ],
    ],
];
