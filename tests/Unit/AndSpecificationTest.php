<?php

declare(strict_types=1);

namespace Kaivladimirv\LaravelSpecificationPattern\Tests\Unit;

use DomainException;
use Exception;
use Kaivladimirv\LaravelSpecificationPattern\AndSpecification;
use Kaivladimirv\LaravelSpecificationPattern\Tests\Dummy\GreaterThanSpecification;
use Kaivladimirv\LaravelSpecificationPattern\Tests\Dummy\LessThanSpecification;
use Kaivladimirv\LaravelSpecificationPattern\Tests\TestCase;

class AndSpecificationTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testSuccess(): void
    {
        $greaterThanSpec = new GreaterThanSpecification(100);
        $lessThanSpec = new LessThanSpecification(200);

        $greaterAndLessThanSpec = new AndSpecification($greaterThanSpec, $lessThanSpec);

        $this->assertTrue($greaterAndLessThanSpec->isSatisfiedBy(150));
        $this->assertFalse($greaterAndLessThanSpec->isSatisfiedBy(50));
        $this->assertFalse($greaterAndLessThanSpec->isSatisfiedBy(250));

        $greaterAndLessThanSpec->throwExceptionIfIsNotSatisfiedBy(190);

        $this->expectException(DomainException::class);
        $greaterAndLessThanSpec->throwExceptionIfIsNotSatisfiedBy(90);
    }
}
