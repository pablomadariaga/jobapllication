<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities_json = file_get_contents(base_path('database/json/cities.json'));
        $cities = json_decode($cities_json);

        $data = [];
        $date = now();

        foreach ($cities as $city) {
            $data[] = [
                'id' => $city->id,
                'state_id' => $city->state_id,
                'country_id' => $city->country_id,
                'name' => $city->name,
                'created_at' => $date,
                'updated_at' => $date,
            ];

            if (count($data)>6000) {
                City::insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            City::insert($data);
            $data = [];
        }
    }
}
