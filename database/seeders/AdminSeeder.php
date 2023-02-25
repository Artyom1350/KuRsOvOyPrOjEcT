<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>"Адмен Адменович Адменов",
            'email'=>"admin@mail.ru",
            'password'=>Hash::make("Asdfg1234!"),
            'role'=>1
        ]);

       /* $user=new User();
        $user->name="Адмен Адменович Адменов";
        $user->email="admin@mail.ru";
        $user->password=Hash::make("Asdfg1234!");
        $user->role=1;
        $user->save();*/
    }
}
