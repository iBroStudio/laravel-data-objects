<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\GitSshUrlRule;
use Illuminate\Validation\ValidationException;

it('passes validation with valid GitSshUrlRule values', function () {
    Validator::make(
        [
            'attribute1' => 'git@github.com:username/repo.git',
            'attribute2' => 'git@gitlab.com:username/repo.git',
            'attribute3' => 'git@bitbucket.org:username/repo.git',
        ],
        [
            'attribute1' => new GitSshUrlRule(),
            'attribute2' => new GitSshUrlRule(),
            'attribute3' => new GitSshUrlRule(),
        ]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('passes validation with null value', function () {
    Validator::make(
        ['attribute' => null],
        ['attribute' => new GitSshUrlRule()]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('fails validation with invalid value', function () {
    Validator::make(
        ['attribute' => 'invalid-value'],
        ['attribute' => new GitSshUrlRule()]
    )
        ->validate();
})->throws(ValidationException::class);
