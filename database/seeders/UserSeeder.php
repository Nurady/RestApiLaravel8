<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::create([
        //     'name' => 'adis',
        //     'email' => 'adis@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'email_verified_at' => now()
        // ]);

        collect([
            [
                'name' => 'adis2',
                'email' => 'adis2@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'yadi',
                'email' => 'yadi@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'izzan',
                'email' => 'izzan@gmail.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ]
        ])->each(function($user) {
            User::create($user);
        });

        collect([
            'admin',
            'moderator'
        ])->each(function($role) {
           Role::create(['name' => $role]);
        });

        User::find(1)->roles()->attach([1]);
        User::find(2)->roles()->attach([2]);
    }
}
