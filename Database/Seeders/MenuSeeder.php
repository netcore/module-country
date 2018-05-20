<?php

namespace Modules\Country\Database\Seeders;

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (!function_exists('menu') || !method_exists(menu(), 'seedItems')) {
            $this->command->error('Menu seeding skipped - old admin module used in this project!');
            return;
        }

        menu()->seedItems([
            'leftAdminMenu' => [
                [
                    'module'          => 'Country',
                    'icon'            => 'fa fa-flag',
                    'type'            => 'route',
                    'active_resolver' => 'country::*',
                    'is_active'       => true,
                    'parameters'      => json_encode([]),
                    'name'            => 'Countries and cities',
                    'value'           => 'country::countries.index',
                ],
            ],
        ]);
    }
}