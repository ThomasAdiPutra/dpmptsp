<?php

namespace Database\Seeders;

use App\Models\ServicePermissionForm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicePermissionFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServicePermissionForm::factory(10)->create();
    }
}
