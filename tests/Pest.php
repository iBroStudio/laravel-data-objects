<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;

uses(TestCase::class, RefreshDatabase::class)->in(__DIR__);

function getFakeSshPublicKey(): string
{
    return File::get(__DIR__.'/Support/Ssh/test.pub');
}

function getFakeSshPrivateKey(): string
{
    return File::get(__DIR__.'/Support/Ssh/test');
}
