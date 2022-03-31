<?php

namespace Database\Seeders;

use App\Models\EmailLog;
use Illuminate\Database\Seeder;

class EmailLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmailLog::factory(10)->create();
    }
}
