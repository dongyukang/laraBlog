<?php

use App\User;
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
            ['id' => '2', 'name' => 'Bob', 'email' => "bob@gmail.com", 'password' => bcrypt('password'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );
        DB::table('users')->insert($users);

        //Attach user roles
        User::find(1)->roles()->attach(2);
        User::find(2)->roles()->attach(1);
    }
}
