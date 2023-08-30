<?php

declare(strict_types=1);

namespace Kaivladimirv\LaravelSpecificationPattern\Tests\Dummy;

use Kaivladimirv\LaravelSpecificationPattern\AbstractSpecification;

class GreaterThanSpecification extends AbstractSpecification
{
    public function __construct(readonly private int|float $number)
    {
    }

    protected function defineMessage(): string
    {
        return "Number must be greater than $this->number";
    }

    protected function executeCheckIsSatisfiedBy(mixed $candidate): bool
    {
        return $candidate > $this->number;
    }
}
