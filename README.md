# BeFuture Core Shared

[![Tests](https://github.com/befuturein/core-shared/actions/workflows/test.yml/badge.svg)](https://github.com/befuturein/core-shared/actions/workflows/test.yml)
[![Latest Stable Version](https://img.shields.io/packagist/v/befuturein/core-shared.svg)](https://packagist.org/packages/befuturein/core-shared)
[![Total Downloads](https://img.shields.io/packagist/dt/befuturein/core-shared.svg)](https://packagist.org/packages/befuturein/core-shared)
[![PHP Version](https://img.shields.io/packagist/php-v/befuturein/core-shared.svg)](https://packagist.org/packages/befuturein/core-shared)
[![License](https://img.shields.io/github/license/befuturein/core-shared.svg)](LICENSE)

Shared core layer for BeFuture applications (contracts, traits, value objects, enums, DTOs, helpers).

## Features

- Contracts (interfaces)
- Traits (UUID, timestamp helpers, macro helpers)
- Value Objects (Email, Phone, Money, Url, Locale, DateTimeValue)
- Enums (Status, Locale, Environment)
- DTO layer with `fromArray()` and `toArray()`
- Result object for service layer consistency
- Common helpers (StringHelper, ArrayHelper, DateHelper)
- Standardized patterns for scalable Laravel applications

## Installation

```
composer require befuturein/core-shared
```

## Why this package exists?

Core Shared provides a standardized foundation for all BeFuture packages and Laravel applications. Its purpose is to eliminate code duplication, centralize cross-cutting logic, and support modular and scalable architectures following SOLID and clean code principles.

## Usage Examples

### UUID Trait

```php
use Illuminate\Database\Eloquent\Model;
use BeFuture\CoreShared\Contracts\HasUuid;
use BeFuture\CoreShared\Traits\UsesUuid;

class User extends Model implements HasUuid
{
    use UsesUuid;
}
```

### Data Transfer Object

```php
use BeFuture\CoreShared\DTOs\DataTransferObject;

class UserDTO extends DataTransferObject
{
    public string $id;
    public string $email;
}

$dto = UserDTO::fromArray([
    'id' => '123',
    'email' => 'test@example.com',
]);
```

### Value Object

```php
use BeFuture\CoreShared\ValueObjects\Email;

$email = Email::from('hello@example.com');
$email->value(); // "hello@example.com"
```

### Enum Example

```php
use BeFuture\CoreShared\Enums\Status;

$status = Status::Active;

if ($status->is(Status::Active)) {
    // ...
}
```

### Result Object

```php
use BeFuture\CoreShared\Support\Result;

return Result::success([
    'message' => 'Operation completed',
]);

return Result::failure('Invalid data provided');
```

## Available Components

| Component | Namespace | Description |
|----------|-----------|-------------|
| Contracts | `CoreShared\\Contracts` | Interfaces shared across layers |
| Traits | `CoreShared\\Traits` | Common reusable behaviors |
| Value Objects | `CoreShared\\ValueObjects` | Immutable domain values |
| Enums | `CoreShared\\Enums` | Strongly typed enums |
| DTOs | `CoreShared\\DTOs` | Clean data transport objects |
| Support | `CoreShared\\Support` | Result & utility classes |

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License

MIT License  
Copyright (c) 2025 Muratcan Kayalak, BeFuture Interactive
