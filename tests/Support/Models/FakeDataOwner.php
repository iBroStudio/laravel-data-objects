<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Tests\Support\Models;

use IBroStudio\DataObjects\Concerns\HasConfig;
use IBroStudio\DataObjects\Concerns\HasOwnClassAsProperty;
use IBroStudio\DataObjects\Contracts\ModelConfigDTOContract;
use IBroStudio\DataObjects\Tests\Support\Database\Factories\FakeDataOwnerFactory;
use IBroStudio\DataObjects\Tests\Support\DTO\FakeDTO;
use IBroStudio\DataObjects\Tests\Support\DTO\FakeModelConfigDto;
use IBroStudio\DataObjects\ValueObjects;
use IBroStudio\DataObjects\ValueObjects\TempFolder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakeDataOwner extends Model
{
    use HasConfig;
    use HasFactory;
    use HasOwnClassAsProperty;

    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'data_object' => FakeDTO::class,
        'text_vo' => ValueObjects\Text::class,
        'boolean_vo' => ValueObjects\Boolean::class,
        'class_vo' => ValueObjects\ClassString::class,
        'company_vo' => ValueObjects\CompanyName::class,
        'domain_vo' => ValueObjects\Domain::class,
        'email_vo' => ValueObjects\Email::class,
        'encryptable_vo' => ValueObjects\EncryptableText::class,
        'firstname_vo' => ValueObjects\FirstName::class,
        'float_vo' => ValueObjects\FloatValueObject::class,
        'fullname_vo' => ValueObjects\FullName::class,
        'giturl_vo' => ValueObjects\GitSshUrl::class,
        'password_vo' => ValueObjects\HashedPassword::class,
        'integer_vo' => ValueObjects\IntegerValueObject::class,
        'ip_vo' => ValueObjects\IpAddress::class,
        'lastname_vo' => ValueObjects\LastName::class,
        'name_vo' => ValueObjects\Name::class,
        'phone_vo' => ValueObjects\Phone::class,
        'version_vo' => ValueObjects\SemanticVersion::class,
        'tmp_folder_vo' => TempFolder::class,
        'timecode_vo' => ValueObjects\Timecode::class,
        'timeduration_vo' => ValueObjects\TimeDuration::class,
        'url_vo' => ValueObjects\Url::class,
        'uuid_vo' => ValueObjects\Uuid::class,
        'vat_number_vo' => ValueObjects\VatNumber::class,
        'basic_auth_vo' => ValueObjects\Authentication\BasicAuthentication::class,
        's3_auth_vo' => ValueObjects\Authentication\S3Authentication::class,
        'ssh_auth_vo' => ValueObjects\Authentication\SshKey::class,
        'auth_vo' => ValueObjects\Authentication\AuthenticationAbstract::class,
    ];

    protected static function newFactory(): Factory
    {
        return FakeDataOwnerFactory::new();
    }

    protected function getConfig(array $properties = []): ModelConfigDTOContract
    {
        return FakeModelConfigDto::from([
            'configClass' => ValueObjects\ClassString::class,
            'configCollection' => [ValueObjects\ClassString::class, ValueObjects\ClassString::class, ValueObjects\ClassString::class],
        ]);
    }
}
