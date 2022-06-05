<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaseAnimalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                DB::table('base_animals')->insert([
            [
                'name' => 'Vasya',
                'kind' => 'cat',
                'size'  => 120,
                'age'  => 20,
                'growth'  => 1.2,
            ],
            [
                'name' => 'Sharic',
                'kind' => 'dog',
                'size'  => 180,
                'age'  => 12,
                'growth'  => 1.3,
            ],
            [
                'name' => 'Kesha',
                'kind' => 'bird',
                'size'  => 100,
                'age'  => 20,
                'growth'  => 1.8,
            ],
            [
                'name' => 'Misha',
                'kind' => 'bear',
                'size'  => 210,
                'age'  => 30,
                'growth'  => 1.2,
            ]
        ]);
    }
}
