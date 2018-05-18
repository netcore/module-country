<?php
namespace Modules\Country\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Country\Models\Currency;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = json_decode(file_get_contents(__DIR__ . '/data/currencies.json'), true);

        foreach ($currencies as $currency) {
            Currency::firstOrCreate([
                'code' => $currency['code']
            ], $currency);
        }
    }
}
