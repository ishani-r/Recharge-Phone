<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'id' => '1',
                'country' => 'India',
            ],
            [
                'id' => '2',
                'country' => 'Australia',
            ],
            [
                'id' => '3',
                'country' => 'Brazil',
            ],
            [
                'id' => '4',
                'country' => 'Mexico',
            ],
            [
                'id' => '5',
                'country' => 'Japan',
            ],
            [
                'id' => '6',
                'country' => 'Iran',
            ],
        ];
        Country::insert($countries);
    }
}
