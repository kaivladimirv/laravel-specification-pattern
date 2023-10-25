<?php

declare(strict_types=1);

namespace Kaivladimirv\LaravelSpecificationPattern;

use DomainException;
use Exception;

abstract class AbstractSpecification implements SpecificationInterface
{
    /**
     * @var array<int, string>
     */
    private array $messages = [];

    final public function isSatisfiedBy(mixed $candidate): bool
    {
        $this->clearMessages();

        return $this->executeCheckIsSatisfiedBy($candidate);
    }

    /**
     * @throws Exception
     */
    final public function throwExceptionIfIsNotSatisfiedBy(mixed $candidate): void
    {
        if (!$this->isSatisfiedBy($candidate)) {
            throw $this->createException($this->getFirstMessage());
        }
    }

    final public function getAllMessages(): array
    {
        return $this->messages;
    }

    final public function getFirstMessage(): string
    {
        return $this->messages[0] ?? '';
    }

    final protected function setMessage(string ...$messages): void
    {
        foreach ($messages as $message) {
            $this->messages[] = $message;
        }
    }

    final protected function clearMessages(): void
    {
        $this->messages = array_filter([$this->defineMessage()]);
    }

    protected function createException(string $message): Exception
    {
        return new ($this->getExceptionClass())($message);
    }

    protected function getExceptionClass(): string
    {
        return DomainException::class;
    }

    abstract protected function defineMessage(): string;

    abstract protected function executeCheckIsSatisfiedBy(mixed $candidate): bool;
}
