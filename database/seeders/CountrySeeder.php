<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries_json = file_get_contents(base_path('database/json/countries.json'));
        $countries = json_decode($countries_json);

        $data = [];
        $date = now();

        foreach ($countries as $country) {
            $phoneCode = $country->phone_code;
            $phoneCode = strpos($phoneCode, ' ') !== false ? explode(' ', $phoneCode)[0] : $phoneCode;
            $phoneCode = str($phoneCode)->contains('+') ? $phoneCode : '+'.$phoneCode;
            $data[] = [
                'id' => $country->id,
                'name' => $country->name,
                'iso2' => $country->iso2,
                'iso3' => $country->iso3,
                'numeric_code' => $country->numeric_code,
                'phone_code' => $phoneCode,
                'currency' => $country->currency,
                'currency_name' => $country->currency_name,
                'currency_symbol' => $country->currency_symbol,
                'native' => $country->native ?? $country->name,
                'region' => $country->region,
                'emoji' => $country->emoji,
                'emojiU' => $country->emojiU,
                'created_at' => $date,
                'updated_at' => $date,
            ];

            if (count($data)>6000) {
                Country::insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            Country::insert($data);
            $data = [];
        }
    }
}
