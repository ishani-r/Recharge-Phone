<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $state = [
            [
                'id' => '1',
                'country_id' => '1',
                'state' => 'Gujarat',
            ],
            [
                'id' => '2',
                'country_id' => '1',
                'state' => 'Bihar',
            ],
            [
                'id' => '3',
                'country_id' => '2',
                'state' => 'Tasmania',
            ],
            [
                'id' => '4',
                'country_id' => '2',
                'state' => 'New South Wales',
            ],
            [
                'id' => '5',
                'country_id' => '3',
                'state' => 'Bahia',
            ],
            [
                'id' => '6',
                'country_id' => '3',
                'state' => 'Paraná',
            ],
            [
                'id' => '7',
                'country_id' => '4',
                'state' => 'Campeche',
            ],
            [
                'id' => '8',
                'country_id' => '4',
                'state' => 'Chiapas',
            ],
            [
                'id' => '9',
                'country_id' => '5',
                'state' => 'Aomori',
            ],
            [
                'id' => '10',
                'country_id' => '5',
                'state' => 'Ehime',
            ],
            [
                'id' => '11',
                'country_id' => '6',
                'state' => 'Isfahan',
            ],
            [
                'id' => '12',
                'country_id' => '6',
                'state' => 'Kerman',
            ],
        ];
        State::insert($state);
    }
}
