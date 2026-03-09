<?php

namespace Database\Seeders;

use Chicorycom\Cigaformation\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles() as $role){
            Role::create([
                'name'=> $role['name'],
                'display_name'=> $role['display_name'],
            ]);
        }
    }

    public function roles(){
        return [
            [
                'name'=> 'isAdmin',
                'display_name'=> 'Administrator',

            ],
            [
                'name'=> 'isManager',
                'display_name'=> 'Web Master',
            ],
            [
                'name'=> 'isSubscriber',
                'display_name'=> 'Users',
            ],

        ];
    }
}
