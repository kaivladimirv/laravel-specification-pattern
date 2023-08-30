<?php

declare(strict_types=1);

namespace Kaivladimirv\LaravelSpecificationPattern;

interface SpecificationInterface
{
    public function isSatisfiedBy(mixed $candidate): bool;

    public function getFirstMessage(): string;

    public function getAllMessages(): array;

    public function throwExceptionIfIsNotSatisfiedBy(mixed $candidate);
}
