<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ChicorycomDatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTable::class);
        $this->command->info('User table seeded!');
        $this->call(MenuItemTable::class);
        $this->command->info('Menus Admin table seeded!');
        $this->call(RoleTableSeeder::class);
        $this->command->info('Roles table seeded!');

    }
}
