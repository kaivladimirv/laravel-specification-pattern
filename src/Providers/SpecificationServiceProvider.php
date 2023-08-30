<?php

declare(strict_types=1);

namespace Kaivladimirv\LaravelSpecificationPattern\Providers;

use Illuminate\Support\ServiceProvider;
use Kaivladimirv\LaravelSpecificationPattern\Console\Commands\MakeSpecificationCommand;

class SpecificationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands(
                commands: [
                    MakeSpecificationCommand::class,
                ],
            );
        }
    }
}
