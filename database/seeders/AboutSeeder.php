<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['logo' => fake()->image()],
            ['profil' => fake()->words(5, true)],
            ['visi' => fake()->words(1, true)],
            ['misi' => fake()->words(10, true)],
            ['struktur_organisasi' => fake()->image(null, $width = 1024, $height = 1024)],
            ['sop' => fake()->words(10, true)],
        ];
        foreach($datas as $data){
            About::create([
                'key' => array_keys($data)[0],
                'value' => array_values($data)[0]
            ]);
        }
    }
}
