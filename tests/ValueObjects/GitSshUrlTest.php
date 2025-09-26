<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\GitProvidersEnum;
use IBroStudio\DataObjects\ValueObjects\GitSshUrl;
use Illuminate\Validation\ValidationException;

it('can instantiate GitSshUrl object value', function () {
    expect(
        GitSshUrl::from('git@github.com:iBroStudio/laravel-data-repository.git')
    )->toBeInstanceOf(GitSshUrl::class);
});

it('can validate GitSshUrl object value', function () {
    GitSshUrl::from('https://github.com/iBroStudio/laravel-data-repository.git');
})->throws(ValidationException::class);

it('can return GitSshUrl object value', function () {
    $url = 'git@github.com:iBroStudio/laravel-data-repository.git';

    expect(
        GitSshUrl::from($url)->value
    )->toEqual($url);
});

it('can return GitSshUrl object value single property', function () {
    $url = GitSshUrl::from('git@github.com:iBroStudio/laravel-data-repository.git');

    expect($url->provider)->toEqual(GitProvidersEnum::GITHUB)
        ->and($url->username)->toEqual('iBroStudio')
        ->and($url->repository)->toEqual('laravel-data-repository');
});

it('can return GitSshUrl object value properties', function () {
    $url = 'git@github.com:iBroStudio/laravel-data-repository.git';

    expect(
        GitSshUrl::from($url)
            ->values()
    )->toMatchArray([
        'value' => $url,
        'username' => 'iBroStudio',
        'repository' => 'laravel-data-repository',
        'provider' => GitProvidersEnum::GITHUB,
    ]);
});

it('can build a GitSshUrl object value', function () {
    expect(
        GitSshUrl::build(
            GitProvidersEnum::GITHUB,
            'iBroStudio',
            'laravel-data-repository'
        )
    )->toBeInstanceOf(GitSshUrl::class);
});

it('can return HTTP url', function () {
    expect(
        GitSshUrl::from('git@github.com:iBroStudio/laravel-data-repository.git')
            ->toHttp()
    )->toBe('https://github.com/iBroStudio/laravel-data-repository');
});

it('can add a branch to the object', function () {
    $git = GitSshUrl::from('git@github.com:iBroStudio/laravel-data-repository.git');
    $git = $git->branch('develop');

    expect($git)->toBeInstanceOf(GitSshUrl::class)
        ->and($git->value)->toBe('git@github.com:iBroStudio/laravel-data-repository.git;develop')
        ->and($git->url)->toBe('git@github.com:iBroStudio/laravel-data-repository.git')
        ->and($git->branch)->toBe('develop');
});

it('can instantiate a GitSshUrl with a branch', function () {
    $git = GitSshUrl::from('git@github.com:iBroStudio/laravel-data-repository.git;develop');

    expect($git)->toBeInstanceOf(GitSshUrl::class)
        ->and($git->value)->toBe('git@github.com:iBroStudio/laravel-data-repository.git;develop')
        ->and($git->url)->toBe('git@github.com:iBroStudio/laravel-data-repository.git')
        ->and($git->branch)->toBe('develop');
});
