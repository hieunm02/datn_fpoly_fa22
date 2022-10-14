<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
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
<<<<<<< HEAD
        // \App\Models\User::factory(10)->create();
        // \App\Models\Price::factory(2)->create();
=======
        User::factory(10)->create();
        News::factory(10)->create();
>>>>>>> dev
    }
}
