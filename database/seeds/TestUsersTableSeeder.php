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

        User::insert([
            [
                'fname' => 'John',
                'lname' => 'Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('123')
            ]
        ]);
    }
}
