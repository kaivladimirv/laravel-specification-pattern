<?php

declare(strict_types=1);

namespace Kaivladimirv\LaravelSpecificationPattern\Tests;

use Illuminate\Support\Facades\File;
use Kaivladimirv\LaravelSpecificationPattern\Console\Commands\MakeSpecificationCommand;

class MakeSpecificationCommandTest extends TestCase
{
    public function testSuccess(): void
    {
        $actualFile = app_path('Specifications/ExampleSpecification.php');
        if (File::exists($actualFile)) {
            unlink($actualFile);
        }

        $command = $this->artisan(
            MakeSpecificationCommand::class,
            ['name' => 'ExampleSpecification']
        );
        $command->assertSuccessful();
        $command->execute();

        $expectedFile = $this->getFixtureFullPath('expected_result_of_command_make_specification.txt');

        $this->assertFileEquals($expectedFile, $actualFile);
    }
}
