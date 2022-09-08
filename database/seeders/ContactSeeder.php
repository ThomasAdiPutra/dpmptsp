<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contacts = [
            ['no_hp' => fake()->phoneNumber()],
            ['email' => fake()->safeEmail()],
            ['alamat' => fake()->address()],
            ['lat' => fake()->latitude()],
            ['lon' => fake()->longitude()],
        ];
        foreach($contacts as $contact) {
            Contact::create([
                'key' => array_key_first($contact),
                'value' => array_values($contact)[0],
            ]);
        }
    }
}
