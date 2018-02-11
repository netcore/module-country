## Description
This module provides helper methods to work with lists of countries and currencies

## Pre-installation
This package is part of Netcore CMS ecosystem and is only functional in a project that has the following packages
installed:

1. https://github.com/netcore/netcore

### Installation

* Require this package using composer
```
composer require netcore/module-country
```

* Publish configuration, migrations and assets
```
php artisan module:publish-config Country
php artisan module:publish-migration Country
php artisan module:publish Country
php artisan migrate
```

* Seed the configuration to database
```
php artisan module:seed Country
```

## Usage

* Get all countries:
```php
country()->all();
```

* Find a country by its `ISO 3166-2` code:
```php
$country = country()->findByCode('SE');
$country->code; // SE
$country->name; // Sweden
$country->capital; // Stockholm
$country->full_name; // Kingdom of Sweden
$country->calling_code; // 46
$country->eea; // true
$country->flag_url; // Will return asset URL to the country flag
```

* Get all countries as a collection for select lists (will return a collection in this format - ID => Country name)
```php
country()->getSelectList();
```

You can also attach a country or a currency to any model:
```php
public function country(): Illuminate\Database\Eloquent\Relations\BelongsTo
{
    return $this->belongsTo(Modules\Country\Models\Country::class);
}
```

```php
public function currency(): Illuminate\Database\Eloquent\Relations\BelongsTo
{
    return $this->belongsTo(Modules\Country\Models\Currency::class);
}
```

## Disclaimer
We take no responsibility for the accuracy of the country, currency and flag lists provided in the source files. The 
lists were made diregarding any political and religious views. If you find the country list inaccurate, feel free to fork
the repository and change the lists how you wish.

## Todo:
* Add unit tests
* Make countries and currencies manageable in the admin panel
