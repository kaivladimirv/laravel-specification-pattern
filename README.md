[![php linter](https://github.com/kaivladimirv/laravel-specification-pattern/actions/workflows/linter-check.yml/badge.svg)](https://github.com/kaivladimirv/laravel-specification-pattern/actions/workflows/linter-check.yml)
[![tests](https://github.com/kaivladimirv/laravel-specification-pattern/actions/workflows/tests-check.yml/badge.svg)](https://github.com/kaivladimirv/laravel-specification-pattern/actions/workflows/tests-check.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/9b3cf2b0022c1d836063/maintainability)](https://codeclimate.com/github/kaivladimirv/laravel-specification-pattern/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/9b3cf2b0022c1d836063/test_coverage)](https://codeclimate.com/github/kaivladimirv/laravel-specification-pattern/test_coverage)
[![Latest Version](https://img.shields.io/packagist/v/kaivladimirv/laravel-specification-pattern.svg?style=flat-square)](https://packagist.org/packages/kaivladimirv/laravel-specification-pattern)
![GitHub](https://img.shields.io/github/license/kaivladimirv/laravel-specification-pattern?link=https%3A%2F%2Fgithub.com%2Fkaivladimirv%2Flaravel-specification-pattern%2Fblob%2Fmain%2FLICENSE)
<a href="https://php.net"><img src="https://img.shields.io/badge/php-8.1%2B-%238892BF" alt="PHP Programming Language"></a>

## Specification pattern for Laravel
Implementation of the Specification pattern in PHP

## Requirements
* PHP 8.1+

## Installation
You can install the package via composer:

``` bash
$ composer require kaivladimirv/laravel-specification-pattern
```

## Usage
You can create a specification using the artisan command:

``` bash
$ php artisan make:specification GreaterThanSpecification
```

This command will create a specification class in the App\Specifications namespace.

``` php
<?php

declare(strict_types=1);

namespace App\Specifications;

use Kaivladimirv\LaravelSpecificationPattern\AbstractSpecification

class GreaterThanSpecification extends AbstractSpecification
{
    protected function defineMessage(): string
    {
        // TODO: Implement defineMessage() method.    
    }

    protected function executeCheckIsSatisfiedBy(mixed $candidate): bool
    {
        return false;
    }
}
```

Adding business logic to the created specification:

``` diff
<?php

declare(strict_types=1);

namespace App\Specifications;

use Kaivladimirv\LaravelSpecificationPattern\AbstractSpecification

class GreaterThanSpecification extends AbstractSpecification
{
+    public function __construct(readonly private int|float $number)
+    {
+    }
+    
    protected function defineMessage(): string
    {
-        // TODO: Implement defineMessage() method.
+        return "Number must be greater than $this->number";    
    }

    protected function executeCheckIsSatisfiedBy(mixed $candidate): bool
    {
-        return false;
+        return $candidate > $this->number;
    }
}
```

After adding business logic, you can use the specification by calling the isSatisfiedBy or throwExceptionIfIsNotSatisfiedBy methods.

### Using the isSatisfiedBy method:
``` php
$greaterThan100Spec = new GreaterThanSpecification(100);

$greaterThan100Spec->isSatisfiedBy(200); // true
$greaterThan100Spec->isSatisfiedBy(99); // false
```

### Using the throwExceptionIfIsNotSatisfiedBy method:
``` php
$greaterThan100Spec = new GreaterThanSpecification(100);

$greaterThan100Spec->throwExceptionIfIsNotSatisfiedBy(200); // No exception will be thrown here
$greaterThan100Spec->isSatisfiedBy(99); // An DomainException will be thrown here with the message "Number must be greater than 100"
```

You can change the exception type in the getExceptionClass method:

``` diff
<?php

declare(strict_types=1);

namespace App\Specifications;

use Kaivladimirv\LaravelSpecificationPattern\AbstractSpecification

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
+    
+    protected function getExceptionClass(): string
+    {
+        return MyException::class;
+    }
}
```

## License
The Task manager project is licensed for use under the MIT License (MIT).
Please see [LICENSE](/LICENSE) for more information.
