<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $admin = \App\Models\User::factory()->create([
            'first_name' => 'Admin',
            'email' => "admin@gmail.com"
        ]);
        $admin->password = bcrypt('password');
        $admin->save();

        $admin->syncRoles('super-admin');


        // customer
        $admin = \App\Models\User::factory()->create([
            'first_name' => 'Customer',
            'email' => "customer@gmail.com"
        ]);
        $admin->password = bcrypt('password');
        $admin->save();

        $admin->syncRoles('customer');



    }
}
