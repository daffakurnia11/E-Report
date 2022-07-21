<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        \App\Models\User::factory(1)->create([
            'roles' => 'GM'
        ]);

        \App\Models\User::factory()->has(
            Project::factory()->count(3)
        )->create([
            'name'          => 'Project Manager Admin',
            'email'         => 'admin_pm@gmail.com',
            'phone'         => '085156317473',
            'password'      => Hash::make('admin'),
            'roles'         => 'PM',
        ]);
        \App\Models\User::factory(2)->has(
            Project::factory()->count(3)
        )->create([
            'roles' => 'PM'
        ]);

        \App\Models\User::factory()->has(
            Block::factory()->count(10)
        )->create([
            'name'          => 'PIC Admin',
            'email'         => 'admin_pic@gmail.com',
            'phone'         => '085156317473',
            'password'      => Hash::make('admin'),
            'roles'         => 'PIC',
        ]);
        \App\Models\User::factory(3)->has(
            Block::factory()->count(10)
        )->create([
            'roles' => 'PIC'
        ]);

        $data_path = 'app/Data/ereport.sql';
        DB::unprepared(file_get_contents($data_path));

        \App\Models\Equipment::factory(150)->create();

        // \App\Models\EquipmentGas::factory(25)->create();

        // \App\Models\EquipmentElectric::factory(25)->create();
    }
}
