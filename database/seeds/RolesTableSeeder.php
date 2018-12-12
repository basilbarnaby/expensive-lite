<?php

use Illuminate\Database\Seeder;
use App\Models\Core\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Role::insert([
            [
                'name' => 'administrator',
                'display_name' => 'Administrator',
                'description' => 'User with Adminstrative privileges'
            ],
            [
                'name' => 'user',
                'display_name' => 'User',
                'description' => 'User with basic privileges'
            ],
        ]);
    }
}
