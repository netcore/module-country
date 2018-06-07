<?php

namespace Modules\Country\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Country\Models\Country;
use Modules\Country\Models\Currency;
use Netcore\Translator\Models\Language;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::query()->delete();

        $countries = json_decode(file_get_contents(__DIR__ . '/data/countries.json'), true);
        $existingCurrencies = Currency::all()->keyBy('code');
        $existingCountries = Country::all()->keyBy('code');

        foreach ($countries as $country) {
            if ($existingCountries->has($country['code'])) {
                continue;
            }

            $countryInstance = Country::create(
                array_only($country, ['code', 'capital', 'calling_code', 'eea'])
            );

            $countryInstance->storeTranslations(
                languages()->mapWithKeys(function (Language $language) use ($country) {
                    return [
                        $language->iso_code => [
                            'name'      => $country['name'],
                            'full_name' => $country['full_name'],
                        ],
                    ];
                })
            );

            if ($currency = $existingCurrencies->get($country['currency_code'])) {
                $countryInstance->currency()->associate($currency);
                $countryInstance->save();
            }
        }
    }
}
