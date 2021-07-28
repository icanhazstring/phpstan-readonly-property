# icanhazstring/phpstan-readonly-property
Support `#[Readonly]` class properties for PHPStan.
This library is used to have a transition from PHP 8.0 to 8.1 until `readonly`
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

## Known limitations
There are some limitations to the static analysis from using 8.1 `readonly` flag.

### Use of multiple setters can't be checked
If you are initializing your `#[Readonly]` property using a setter, PHPStan can NOT detect
multiple calls of that setter to a readonly property.

```
final class Fu
{
    #[Readonly]
    public string $value;

    public function setValue(string $value)
    {
        $this->value = $value;
    }
}

$fu = new Fu();
$fu->setValue('bar');
$fu->setValue('baz'); // Will work with this extension, but NOT with 8.1 `readonly`
```
