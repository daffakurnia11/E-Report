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
            'name'          => 'Daffa Kurnia Fatah',
            'username'      => 'admin',
            'email'         => 'admin@gmail.com',
            'phone'         => '085156317473',
            'password'      => Hash::make('password'),
            'roles'         => 'Admin',
            'verified_at'   => Carbon::now()
        ]);

        \App\Models\User::factory(9)->create();

        \App\Models\Project::factory(20)->create();
    }
}
