<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name'          => 'Administrator',
            'email'         => 'admin@gmail.com',
            'phone'         => '085156317473',
            'password'      => Hash::make('admin'),
            'roles'         => 'Admin',
        ]);

        \App\Models\User::factory()->create([
            'name'          => 'General Manager Admin',
            'email'         => 'admin_gm@gmail.com',
            'phone'         => '085156317473',
            'password'      => Hash::make('admin'),
            'roles'         => 'GM',
        ]);
        \App\Models\User::factory(2)->create([
            'roles' => 'GM'
        ]);

        \App\Models\User::factory()->create([
            'name'          => 'Project Manager Admin',
            'email'         => 'admin_pm@gmail.com',
            'phone'         => '085156317473',
            'password'      => Hash::make('admin'),
            'roles'         => 'PM',
        ]);
        \App\Models\User::factory(4)->create([
            'roles' => 'PM'
        ]);

        \App\Models\User::factory()->create([
            'name'          => 'PIC Admin',
            'email'         => 'admin_pic@gmail.com',
            'phone'         => '085156317473',
            'password'      => Hash::make('admin'),
            'roles'         => 'PIC',
        ]);
        \App\Models\User::factory(6)->create([
            'roles' => 'PIC'
        ]);

        \App\Models\Project::factory(20)->create();

        \App\Models\Block::factory(100)->create();
    }
}
