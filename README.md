# icanhazstring/phpstan-readonly-property
Support `#[Readonly]` promoted constructor properties for PHPStan.
This library is used to have a full transition from PHP8.0 to 8.1 until `readonly`
keyword will be introduced.

## Installation

```bash
composer require --dev icanhazstring/phpstan-readonly-property
```

Then use PHPStan Extension Installer using

```bash
composer require --dev phpstan/extension-installer
```

or manually add `vendor/icanhazstring/phpstan-readonly-property/rules.neon` into your `phpstan.neon` configuration.

```neon
# phpstan.neon

includes:
    - vendor/icanhazstring/phpstan-readonly-property/rules.neon
```

## Usage
Add `#[Readonly]` to the property you want to have readonly only.

```php
<?php

final class User
{
    public function __constrct(
        #[Readonly] public string $name
    ) {}
}

$user = new User('fu');
$user->name = 'bar'; // Will fail
```
