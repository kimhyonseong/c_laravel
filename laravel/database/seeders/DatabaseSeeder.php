<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->call(UserTableSeeder::class);
        $this->command->info('users table seeded');

        $this->call(PostTableSeeder::class);
        $this->command->info('posts table seeded');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
