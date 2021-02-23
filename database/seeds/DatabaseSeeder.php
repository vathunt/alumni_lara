<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Fathan Bashori',
            'username' => 'admin',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'id_status' => 1,
        ]);
    }
}
