<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File;

use IBroStudio\DataObjects\Contracts\Handlers\File\ClassHandlerContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\FileHandlerContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\ImportHandlerContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\MethodHandlerContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\NamespaceHandlerContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\PropertyHandlerContract;
use IBroStudio\DataObjects\Enums\FileHandlerTypeEnum;
use IBroStudio\DataObjects\Handlers\File\Php\ClassHandler;
use IBroStudio\DataObjects\Handlers\File\Php\Finder;
use IBroStudio\DataObjects\Handlers\File\Php\ImportHandler;
use IBroStudio\DataObjects\Handlers\File\Php\MethodHandler;
use IBroStudio\DataObjects\Handlers\File\Php\NamespaceHandler;
use IBroStudio\DataObjects\Handlers\File\Php\Nodes\ImportNode;
use IBroStudio\DataObjects\Handlers\File\Php\Nodes\MethodNode;
use IBroStudio\DataObjects\Handlers\File\Php\PropertyHandler;
use IBroStudio\DataObjects\ValueObjects\DataFile;
use IBroStudio\DataObjects\ValueObjects\TempFolder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use PhpParser\Node\Stmt;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;

final class PhpFileHandler implements FileHandlerContract
{
    /** @var Stmt[]|string|null */
    public array|string|null $statement;

    public FileHandlerTypeEnum $fileType;

    public Finder $finder;

    private ?NamespaceHandler $namespace = null;

    private ?ClassHandler $class = null;

    public function __construct(private readonly DataFile $dataFile)
    {
        $this->parse();
    }

    public function parse(): void
    {
        $this->statement = (new ParserFactory)
            ->createForNewestSupportedVersion()
            ->parse($this->dataFile->content());

        $this->fileType = collect($this->statement)
            ->reduce(function (mixed $carry, Stmt $node) {

                return match (get_class($node)) {
                    Stmt\Namespace_::class, Stmt\Use_::class, Stmt\Class_::class => FileHandlerTypeEnum::ClassFile,
                    Stmt\Return_::class => FileHandlerTypeEnum::ArrayFile,
                    default => null,
                };
            });

        $this->finder = new Finder($this);
    }

    public function namespace(): ?NamespaceHandlerContract
    {
        if (is_null($this->namespace)) {
            $this->namespace = new NamespaceHandler($this);
        }

        return $this->namespace;
    }

    public function class(): ?ClassHandlerContract
    {
        if (is_null($this->class)) {
            $this->class = new ClassHandler($this);
        }

        return $this->class;
    }

    public function imports(): ?ImportHandlerContract
    {
        return new ImportHandler($this);
    }

    public function properties(): ?PropertyHandlerContract
    {
        return new PropertyHandler($this);
    }

    public function methods(): ?MethodHandlerContract
    {
        return new MethodHandler($this);
    }

    public function addFromStub(DataFile $stub): bool
    {
        $importHandler = $this->imports();
        $methodHandler = $this->methods();

        $stub->imports()->all()->each(
            fn (ImportNode $import) => $importHandler->add($import)
        );

        $stub->methods()->all()->each(
            fn (MethodNode $method) => $methodHandler->add($method)
        );

        return $this->save();

        // $stub->handler->imports()
        // $stub->handler->properties()
        // $stub->handler->methods()
    }

    public function removeStub(DataFile $stub): bool
    {
        $methodHandler = $this->methods();

        $stub->methods()->all()->each(
            fn (MethodNode $method) => $methodHandler->remove($method)
        );

        return $this->save();
    }

    public function print(): string
    {
        return new Standard()->prettyPrintFile($this->statement);
    }

    public function save(): bool
    {
        $tmp = TempFolder::make();

        File::put($tmp->path($this->dataFile->value), $this->print());

        $format = Process::run('vendor/bin/pint '.$tmp->path($this->dataFile->value));

        return $format->successful()
            && $this->dataFile->disk->filesystem->put($this->dataFile->value, File::get($tmp->path($this->dataFile->value)));
    }
}
