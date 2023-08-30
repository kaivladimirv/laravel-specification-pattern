<?php

declare(strict_types=1);

namespace Kaivladimirv\LaravelSpecificationPattern\Tests\Dummy;

use Kaivladimirv\LaravelSpecificationPattern\AbstractSpecification;

class EqualZeroSpecification extends AbstractSpecification
{
    protected function defineMessage(): string
    {
        return 'Number must be zero';
    }

    protected function executeCheckIsSatisfiedBy(mixed $candidate): bool
    {
        return $candidate === 0;
    }
}
