<?php

use Illuminate\Database\Seeder;
use App\Models\Core\User;

class TestUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Db::table('role_user')->truncate();

        User::insert([
            [
                'fname' => 'Basil',
                'lname' => 'Barnaby',
                'email' => 'basil@example.com',
                'password' => Hash::make('123')
            ],
            [
                'fname' => 'John',
                'lname' => 'Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('123')
            ]
        ]);

        DB::table('role_user')->insert([
            [
                'role_id' => 1, 
                'user_id' => 1, 
                'user_type' => 'App\Models\Core\User'
            ],
            [
                'role_id' => 2, 
                'user_id' => 2, 
                'user_type' => 'App\Models\Core\User'
            ],
        ]);

    }
}
