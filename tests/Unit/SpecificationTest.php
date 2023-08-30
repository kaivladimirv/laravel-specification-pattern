<?php

declare(strict_types=1);

namespace Kaivladimirv\LaravelSpecificationPattern\Tests\Unit;

use DomainException;
use Exception;
use Kaivladimirv\LaravelSpecificationPattern\Tests\Dummy\GreaterThanSpecification;
use Kaivladimirv\LaravelSpecificationPattern\Tests\TestCase;

class SpecificationTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testSuccess(): void
    {
        $greaterThanSpec = new GreaterThanSpecification(100);

        $this->assertTrue($greaterThanSpec->isSatisfiedBy(200));
        $this->assertFalse($greaterThanSpec->isSatisfiedBy(99));

        $greaterThanSpec->throwExceptionIfIsNotSatisfiedBy(300);

        $this->expectException(DomainException::class);
        $greaterThanSpec->throwExceptionIfIsNotSatisfiedBy(99);
    }
}
