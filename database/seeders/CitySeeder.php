<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = [
            [
                'id' => '1',
                'state_id' => '1',
                'city' => 'Surat',
            ],
            [
                'id' => '2',
                'state_id' => '1',
                'city' => 'Vapi',
            ],
            [
                'id' => '3',
                'state_id' => '2',
                'city' => 'Hajipur',
            ],
            [
                'id' => '4',
                'state_id' => '2',
                'city' => 'Dehri',
            ],
            [
                'id' => '5',
                'state_id' => '3',
                'city' => 'Hobart',
            ],
            [
                'id' => '6',
                'state_id' => '3',
                'city' => 'Devonport',
            ],
            [
                'id' => '7',
                'state_id' => '4',
                'city' => 'Ballina',
            ],
            [
                'id' => '8',
                'state_id' => '4',
                'city' => 'Wollongong',
            ],
            [
                'id' => '9',
                'state_id' => '5',
                'city' => 'Abaíra',
            ],
            [
                'id' => '10',
                'state_id' => '5',
                'city' => 'Barra',
            ],
            [
                'id' => '11',
                'state_id' => '6',
                'city' => 'Colombo',
            ],
            [
                'id' => '12',
                'state_id' => '6',
                'city' => 'Maringá',
            ],
            [
                'id' => '13',
                'state_id' => '7',
                'city' => 'Carmen',
            ],
            [
                'id' => '14',
                'state_id' => '7',
                'city' => 'Calkiní',
            ],
            [
                'id' => '15',
                'state_id' => '8',
                'city' => 'Tuxtla Gutierrez',
            ],
            [
                'id' => '16',
                'state_id' => '8',
                'city' => 'Palenque',
            ],
            [
                'id' => '17',
                'state_id' => '9',
                'city' => 'Aomori',
            ],
            [
                'id' => '18',
                'state_id' => '9',
                'city' => 'Hirosaki',
            ],
            [
                'id' => '19',
                'state_id' => '10',
                'city' => 'Matsuyama',
            ],
            [
                'id' => '20',
                'state_id' => '10',
                'city' => 'Imabari',
            ],
            [
                'id' => '21',
                'state_id' => '11',
                'city' => 'Abrisham',
            ],
            [
                'id' => '22',
                'state_id' => '11',
                'city' => 'Afus',
            ],
            [
                'id' => '23',
                'state_id' => '12',
                'city' => 'Anduhjerd',
            ],
            [
                'id' => '24',
                'state_id' => '12',
                'city' => 'Arzuiyeh',
            ],
        ];
        City::insert($city);
    }
}
