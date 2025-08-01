<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Tests\Support\Database\Factories;

use IBroStudio\DataObjects\Tests\Support\Models\FakeDataOwner;
use IBroStudio\DataObjects\ValueObjects\ClassString;
use IBroStudio\DataObjects\ValueObjects\TempFolder;
use Illuminate\Database\Eloquent\Factories\Factory;

class FakeDataOwnerFactory extends Factory
{
    protected $model = FakeDataOwner::class;

    public function definition()
    {
        $valueObjects = [
            'text_vo' => fake()->text,
            'boolean_vo' => fake()->boolean,
            'class_vo' => ClassString::class,
            'company_vo' => fake()->company,
            'domain_vo' => fake()->domainName,
            'email_vo' => fake()->email,
            'encryptable_vo' => fake()->word,
            'firstname_vo' => fake()->firstName,
            'float_vo' => fake()->randomFloat(),
            'fullname_vo' => fake()->name,
            'giturl_vo' => 'git@github.com:iBroStudio/laravel-data-objects.git',
            'password_vo' => fake()->password,
            'integer_vo' => fake()->randomDigitNotNull(),
            'ip_vo' => fake()->ipv4,
            'lastname_vo' => fake()->lastName,
            'name_vo' => fake()->name,
            'phone_vo' => fake()->e164PhoneNumber,
            'version_vo' => fake()->semver,
            'ssh_key_vo' => [
                'reference' => fake()->uuid,
                'publicKey' => getFakeSshPublicKey(),
            ],
            'tmp_folder_vo' => TempFolder::make(),
            'timecode_vo' => fake()->time('H:i:s:v'),
            'timeduration_vo' => fake()->time('H:i:s'),
            'url_vo' => fake()->url,
            'uuid_vo' => fake()->uuid,
            'vat_number_vo' => 'FR54879706885',
            'basic_auth_vo' => [
                'username' => fake()->userName,
                'password' => fake()->password,
            ],
            's3_auth_vo' => [
                'key' => fake()->uuid,
                'secret' => fake()->password,
            ],
            'ssh_auth_vo' => [
                'username' => fake()->userName,
                'sshKey' => [
                    'reference' => fake()->uuid,
                    'publicKey' => getFakeSshPublicKey(),
                ],
            ],
            'auth_vo' => fake()->randomElement([
                [
                    'username' => getFakeSshPublicKey(),
                    'password' => fake()->password(),
                ],
                [
                    'key' => fake()->uuid,
                    'secret' => fake()->password,
                ],
                [
                    'username' => fake()->userName,
                    'sshKey' => [
                        'reference' => fake()->uuid,
                        'publicKey' => getFakeSshPublicKey(),
                    ],
                ],
            ]),
        ];

        return [
            'data_object' => [
                'string' => fake()->word,
                ...$valueObjects,
            ],
            ...$valueObjects,
        ];
    }
}
