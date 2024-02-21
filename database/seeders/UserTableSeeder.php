<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            //admin
            [
                'name' => 'Wafa',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'role' => 'admin',
                'userID' => 980824020338
                
            ],

            //staff
            [
                'name' => 'Aina',
                'email' => 'staff@gmail.com',
                'password' => bcrypt('staff'),
                'role' => 'staff',
                'userID' => 110823020331
            ],

            //jkk
            [
                'name' => 'Dini',
                'email' => 'jkk@gmail.com',
                'password' => bcrypt('jkk'),
                'role' => 'jkk',
                'userID' => 150823020331

            ],
        ]);
    }
}
