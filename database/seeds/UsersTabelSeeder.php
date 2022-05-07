<?php

use Illuminate\Database\Seeder;

class UsersTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = \App\User::create([
            'name' => 'Super Admin',
            'email' => 'superAdmin@superAdmin.com',
            'admin' => '1',
            'password' => bcrypt('password'),
        ]);
        $superAdmin->attachRole('super_admin');

        $admin = \App\User::create([
            'name' => 'Admin Admin',
            'email' => 'admin@admin.com',
            'admin' => '1',
            'password' => bcrypt('password'),
        ]);
        $admin->attachRole('admin');

        $user = \App\User::create([
            'name' => 'User User',
            'email' => 'user@user.com',
            'admin' => '0',
            'password' => bcrypt('password'),
        ]);
        $user->attachRole('user');
    }
}
