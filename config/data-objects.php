<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Casts\DTOValueObjetCastTransformer;
use IBroStudio\DataObjects\ValueObjects;

return [
    'dto' => [
        'casts' => [
            ValueObjects\Text::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Boolean::class => DTOValueObjetCastTransformer::class,
            ValueObjects\ClassString::class => DTOValueObjetCastTransformer::class,
            ValueObjects\CompanyName::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Domain::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Email::class => DTOValueObjetCastTransformer::class,
            ValueObjects\EncryptableText::class => DTOValueObjetCastTransformer::class,
            ValueObjects\FirstName::class => DTOValueObjetCastTransformer::class,
            ValueObjects\FloatValueObject::class => DTOValueObjetCastTransformer::class,
            ValueObjects\FullName::class => DTOValueObjetCastTransformer::class,
            ValueObjects\GitSshUrl::class => DTOValueObjetCastTransformer::class,
            ValueObjects\HashedPassword::class => DTOValueObjetCastTransformer::class,
            ValueObjects\IntegerValueObject::class => DTOValueObjetCastTransformer::class,
            ValueObjects\IpAddress::class => DTOValueObjetCastTransformer::class,
            ValueObjects\LastName::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Name::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Phone::class => DTOValueObjetCastTransformer::class,
            ValueObjects\SemanticVersion::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Timecode::class => DTOValueObjetCastTransformer::class,
            ValueObjects\TimeDuration::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Url::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Uuid::class => DTOValueObjetCastTransformer::class,
            ValueObjects\VatNumber::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Authentication\BasicAuthentication::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Authentication\S3Authentication::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Authentication\SshKey::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Authentication\AuthenticationAbstract::class => DTOValueObjetCastTransformer::class,
        ],

        'transformers' => [
            ValueObjects\Text::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Boolean::class => DTOValueObjetCastTransformer::class,
            ValueObjects\ClassString::class => DTOValueObjetCastTransformer::class,
            ValueObjects\CompanyName::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Domain::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Email::class => DTOValueObjetCastTransformer::class,
            ValueObjects\EncryptableText::class => DTOValueObjetCastTransformer::class,
            ValueObjects\FirstName::class => DTOValueObjetCastTransformer::class,
            ValueObjects\FloatValueObject::class => DTOValueObjetCastTransformer::class,
            ValueObjects\FullName::class => DTOValueObjetCastTransformer::class,
            ValueObjects\GitSshUrl::class => DTOValueObjetCastTransformer::class,
            ValueObjects\HashedPassword::class => DTOValueObjetCastTransformer::class,
            ValueObjects\IntegerValueObject::class => DTOValueObjetCastTransformer::class,
            ValueObjects\IpAddress::class => DTOValueObjetCastTransformer::class,
            ValueObjects\LastName::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Name::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Phone::class => DTOValueObjetCastTransformer::class,
            ValueObjects\SemanticVersion::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Timecode::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Url::class => DTOValueObjetCastTransformer::class,
            ValueObjects\Uuid::class => DTOValueObjetCastTransformer::class,
            ValueObjects\VatNumber::class => DTOValueObjetCastTransformer::class,
        ],
    ],
];
