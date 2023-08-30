<?php

declare(strict_types=1);

namespace Kaivladimirv\LaravelSpecificationPattern\Tests;

use Kaivladimirv\LaravelSpecificationPattern\Providers\SpecificationServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            SpecificationServiceProvider::class,
        ];
    }

    public function getFixtureFullPath(string $fixtureName): string
    {
        $parts = [__DIR__, 'fixtures', $fixtureName];

        return realpath(implode('/', $parts));
    }
}
