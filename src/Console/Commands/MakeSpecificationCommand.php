<?php

declare(strict_types=1);

namespace Kaivladimirv\LaravelSpecificationPattern\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeSpecificationCommand extends GeneratorCommand
{
    protected $signature = 'make:specification {name}';

    protected $description = 'Create a new specification class';

    protected $type = 'Specification';

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/Specification.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "$rootNamespace\\Specifications";
    }
}
