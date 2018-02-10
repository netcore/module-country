<?php
namespace Modules\Country\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Country\Models\Country;
use Modules\Country\Models\Currency;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = json_decode(file_get_contents(__DIR__ . '/data/countries.json'), true);

        foreach ($countries as $country) {
            if (!Country::where('code', $country['code'])->first()) {
                $model = Country::create(array_except($country, 'currency_code'));

                if ($currency = Currency::where('code', $country['currency_code'])->first()) {
                    $model->currency()->associate($currency);
                    $model->save();
                }
            }
        }
    }
}
