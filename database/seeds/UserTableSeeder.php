<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            ['id' => '1', 'name' => 'Jake', 'email' => "jake@gmail.com", 'password' => bcrypt('password'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );
        DB::table('users')->insert($users);
    }
}
