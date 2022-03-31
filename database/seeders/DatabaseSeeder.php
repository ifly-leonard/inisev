<?php

namespace Database\Seeders;

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
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(WebsiteSeeder::class);
        $this->call(SubscriptionSeeder::class);
        $this->call(EmailLogSeeder::class);
    }
}
