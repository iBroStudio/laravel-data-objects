<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Tests\Support\DTO;

use IBroStudio\DataObjects\ValueObjects;
use Spatie\LaravelData\Data;

class FakeDTO extends Data
{
    public function __construct(
        public string $string,
        public ValueObjects\Text $text_vo,
        public ValueObjects\Boolean $boolean_vo,
        public ValueObjects\ClassString $class_vo,
        public ValueObjects\CompanyName $company_vo,
        public ValueObjects\Domain $domain_vo,
        public ValueObjects\Email $email_vo,
        public ValueObjects\EncryptableText $encryptable_vo,
        public ValueObjects\FirstName $firstname_vo,
        public ValueObjects\FloatValueObject $float_vo,
        public ValueObjects\FullName $fullname_vo,
        public ValueObjects\GitSshUrl $giturl_vo,
        public ValueObjects\HashedPassword $password_vo,
        public ValueObjects\IntegerValueObject $integer_vo,
        public ValueObjects\IpAddress $ip_vo,
        public ValueObjects\LastName $lastname_vo,
        public ValueObjects\Name $name_vo,
        public ValueObjects\Phone $phone_vo,
        public ValueObjects\SemanticVersion $version_vo,
        public ValueObjects\TempFolder $tmp_folder_vo,
        public ValueObjects\Timecode $timecode_vo,
        public ValueObjects\TimeDuration $timeduration_vo,
        public ValueObjects\Url $url_vo,
        public ValueObjects\Uuid $uuid_vo,
        public ValueObjects\VatNumber $vat_number_vo,
        public ValueObjects\Authentication\BasicAuthentication $basic_auth_vo,
        public ValueObjects\Authentication\S3Authentication $s3_auth_vo,
        public ValueObjects\Authentication\SshKey $ssh_auth_vo,
        public ValueObjects\Authentication\AuthenticationAbstract $auth_vo,
    ) {}
}
