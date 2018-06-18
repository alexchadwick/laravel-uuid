# Laravel UUID

Laravel package to generate and validate (UUID)s according to RFC 4122 standard.

**Support for version 4 currently only..**

Laravel 5.5 package auto discovery support.

## Installation

Install to your project using composer by running the following command:

```
composer require "alexchadwick/laravel-uuid
```

For Laravel 5.5, after installation you should see:

```
Discovered Package: alexchadwick/laravel-uuid
```

## Usage

#### To generate UUID

```php
$uuid = (string) Uuid::generate()
```

OR

```php
$uuid = Uuid::generate()->string
```

#### To generate specific version of UUID
```php
//generate UUIDv4
$uuid = (string) Uuid::generate(4)
```

OR

```php
//generate UUIDv4
$uuid = Uuid::uuid4(4)
```

### Eloquent model UUID

The built in Trait "HasUuidPrimaryKey", will automatically generate a UUIDv4 and set it on the model's primary key field when creating model.

This will not affect model events since the Trait makes uses Laravel Model's bootTraits() function.

## Validation
Using the Laravel validator, you can now pass the rule name "uuid" to validate UUIDs.

Laravel validator rule example
```php
'YOUR-UUID-FIELD' => 'uuid'
```

## Running tests

Tests are location in ./test, run phpunit to run built test.