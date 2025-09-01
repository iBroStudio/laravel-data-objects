<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Facades;

use IBroStudio\DataObjects\Managers\SshCommandManager;
use Illuminate\Support\Facades\Facade;
use Spatie\Ssh\Ssh;

/**
 * @method static Ssh create(string $user, string $host, int $port = 22)
 * @method static void fake(array $responses = [])
 * @method static void assertExecuted(string $command)
 * @method static void assertNotExecuted(string $command)
 * @method static array getExecutedCommands()
 *
 * @see SshCommandManager
 */
class SshCommand extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SshCommandManager::class;
    }
}
