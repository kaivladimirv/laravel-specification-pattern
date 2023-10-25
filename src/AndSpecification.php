<?php

declare(strict_types=1);

namespace Kaivladimirv\LaravelSpecificationPattern;

class AndSpecification extends AbstractSpecification
{
    /**
     * @var array<int, SpecificationInterface>
     */
    private array $specifications;

    final public function __construct(SpecificationInterface ...$specifications)
    {
        $this->specifications = $specifications;
    }

    protected function defineMessage(): string
    {
        return '';
    }

    protected function executeCheckIsSatisfiedBy(mixed $candidate): bool
    {
        foreach ($this->specifications as $specification) {
            if (!$specification->isSatisfiedBy($candidate)) {
                $this->setMessage(...$specification->getAllMessages());

                return false;
            }
        }

        return true;
    }
}
