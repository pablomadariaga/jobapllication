<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states_json = file_get_contents(base_path('database/json/states.json'));
        $states = json_decode($states_json);

        $data = [];
        $date = now();

        foreach ($states as $state) {
            $data[] = [
                'id' => $state->id,
                'country_id' => $state->country_id,
                'name' => $state->name,
                'iso2' => $state->state_code,
                'type' => $state->type,
                'created_at' => $date,
                'updated_at' => $date,
            ];

            if (count($data)>6000) {
                State::insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            State::insert($data);
            $data = [];
        }
    }
}
