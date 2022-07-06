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
            'username'      => 'daffakurnia11',
            'email'         => 'daffakurniaf11@gmail.com',
            'phone'         => '085156317473',
            'password'      => Hash::make('password'),
            'roles'         => 'Admin',
            'verified_at'   => Carbon::now()
        ]);

        \App\Models\User::factory(19)->create();
    }
}
