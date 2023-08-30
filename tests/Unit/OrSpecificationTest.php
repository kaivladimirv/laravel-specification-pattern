<?php

declare(strict_types=1);

namespace Kaivladimirv\LaravelSpecificationPattern\Tests\Unit;

use DomainException;
use Exception;
use Kaivladimirv\LaravelSpecificationPattern\OrSpecification;
use Kaivladimirv\LaravelSpecificationPattern\Tests\Dummy\EqualZeroSpecification;
use Kaivladimirv\LaravelSpecificationPattern\Tests\Dummy\GreaterThanSpecification;
use Kaivladimirv\LaravelSpecificationPattern\Tests\TestCase;

class OrSpecificationTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testSuccess(): void
    {
        $greaterThanSpec = new GreaterThanSpecification(100);
        $equalZeroSpec = new EqualZeroSpecification();

        $equalZeroOrGreaterThanSpec = new OrSpecification($equalZeroSpec, $greaterThanSpec);

        $this->assertTrue($equalZeroOrGreaterThanSpec->isSatisfiedBy(150));
        $this->assertTrue($equalZeroOrGreaterThanSpec->isSatisfiedBy(0));
        $this->assertFalse($equalZeroOrGreaterThanSpec->isSatisfiedBy(50));
        $this->assertFalse($equalZeroOrGreaterThanSpec->isSatisfiedBy(-20));

        $equalZeroOrGreaterThanSpec->throwExceptionIfIsNotSatisfiedBy(190);
        $equalZeroOrGreaterThanSpec->throwExceptionIfIsNotSatisfiedBy(0);

        $this->expectException(DomainException::class);
        $equalZeroOrGreaterThanSpec->throwExceptionIfIsNotSatisfiedBy(-30);
    }
}
