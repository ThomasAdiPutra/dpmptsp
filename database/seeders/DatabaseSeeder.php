<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();
        $this->call(AboutSeeder::class);
        $this->call(AgendaSeeder::class);
        $this->call(AnnouncementSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ComplaintSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(GallerySeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(RelatedLinkSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(ServicePermissionSeeder::class);
        $this->call(ServicePermissionFormSeeder::class);
        $this->call(UserSocialMediaSeeder::class);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
