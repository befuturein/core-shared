# befuturein/core-shared

[![Tests](https://github.com/befuturein/core-shared/actions/workflows/test.yml/badge.svg)](https://github.com/befuturein/core-shared/actions/workflows/test.yml)
[![Latest Stable Version](https://img.shields.io/packagist/v/befuturein/core-shared.svg)](https://packagist.org/packages/befuturein/core-shared)
[![Total Downloads](https://img.shields.io/packagist/dt/befuturein/core-shared.svg)](https://packagist.org/packages/befuturein/core-shared)
[![PHP Version](https://img.shields.io/packagist/php-v/befuturein/core-shared.svg)](https://packagist.org/packages/befuturein/core-shared)
[![License](https://img.shields.io/github/license/befuturein/core-shared.svg)](LICENSE)

Shared core layer for BeFuture applications (contracts, traits, value objects, enums, DTOs).

## Installation

```bash
composer require befuturein/core-shared
```

## Usage

```php
use Illuminate\Database\Eloquent\Model;
use BeFuture\CoreShared\Contracts\HasUuid;
use BeFuture\CoreShared\Traits\UsesUuid;

class User extends Model implements HasUuid
{
    use UsesUuid;
}
```
