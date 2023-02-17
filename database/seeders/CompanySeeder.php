<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = new Company();
        $company->name = "Pink tequila";
        $company->logo = "pink-tequila";
        $company->color = "#db2777"; #c026d3;
        $company->email = "jobs@azulmayainc.com";
        $company->optional_email = "popublindado@gmail.com";
        $company->save();

        $company = new Company();
        $company->name = "Blue tequila";
        $company->logo = "blue-tequila";
        $company->color = "#4f46e5";
        $company->email = "jobs@azulmayainc.com";
        $company->optional_email = "popublindado@gmail.com";
        $company->save();

        $company = new Company();
        $company->name = "Lime tequila";
        $company->logo = "lime-tequila";
        $company->color = "#65a30d"; #059669;
        $company->email = "jobs@azulmayainc.com";
        $company->optional_email = "popublindado@gmail.com";
        $company->save();

        $company = new Company();
        $company->name = "Pineapple tequila";
        $company->logo = "pineapple-tequila";
        $company->color = "#fff800"; #059669;
        $company->email = "jobs@azulmayainc.com";
        $company->optional_email = "popublindado@gmail.com";
        $company->save();
    }
}
