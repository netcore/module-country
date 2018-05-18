<?php

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;
use Modules\Country\Models\City;
use Modules\Country\Models\Country;

// Countries.
Breadcrumbs::register('admin.countries', function (BreadcrumbsGenerator $generator) {
    $generator->parent('admin');
    $generator->push('Countries', route('country::countries.index'));
});

Breadcrumbs::register('admin.countries.edit', function (BreadcrumbsGenerator $generator, Country $country) {
    $generator->parent('admin.countries');
    $generator->push('Edit country - ' . $country->name, route('country::countries.edit', $country));
});

// Cities.
Breadcrumbs::register('admin.countries.cities', function (BreadcrumbsGenerator $generator, Country $country) {
    $generator->parent('admin.countries.edit', $country);
    $generator->push('Cities', route('country::countries.cities.index', $country));
});

Breadcrumbs::register('admin.countries.cities.create', function (BreadcrumbsGenerator $generator, Country $country) {
    $generator->parent('admin.countries.edit', $country);
    $generator->push('Create city', route('country::countries.cities.create', $country));
});

Breadcrumbs::register('admin.countries.cities.edit', function (BreadcrumbsGenerator $generator, Country $country, City $city) {
    $generator->parent('admin.countries.edit', $country);
    $generator->push('Edit city - ' . $city->name, route('country::countries.cities.edit', [$country, $city]));
});