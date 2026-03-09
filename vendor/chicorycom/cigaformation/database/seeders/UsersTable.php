<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Chicorycom\Cigaformation\Models\User::create([
            'name' => 'Assane Sarr',
            'Company' => 'Chicorycom',
            'role' => 'isAdmin',
            'email' => 'contact@chicorycom.net',
            'password' => bcrypt('1234567890')
        ]);
    }
}
