<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
            'name'=>"Адмен Адменович Адменов",
            'email'=>"admin@mail.ru",
            'password'=>Hash::make("Asdfg1234!"),
            'role'=>1,
        ]);
    }
}
