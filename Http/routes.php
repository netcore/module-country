<?php


Route::group([
    'middleware' => ['web', 'auth.admin'],
    'prefix'     => 'admin/country',
    'namespace'  => '\Modules\Country\Http\Controllers',
    'as'         => 'country::',
], function () {
    Route::post('countries/{country}/toggle', 'CountryController@toggleActiveState');

    Route::resource('countries', 'CountryController');
    Route::resource('countries.cities', 'CityController');
    Route::resource('currencies', 'CurrencyController');
});
