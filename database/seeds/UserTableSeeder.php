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
            ['id' => '1', 'name' => 'jake', 'email' => "jake@gmail.com", 'password' => bcrypt('password'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => '2', 'name' => 'bob', 'email' => "bob@gmail.com", 'password' => bcrypt('password'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => '3', 'name' => 'boss', 'email' => "bossman@gmail.com", 'password' => bcrypt('password'), 'created_at' => new DateTime, 'updated_at' => new DateTime],

        );
        DB::table('users')->insert($users);

        //Attach user roles
        User::find(1)->roles()->attach(2); //Make jake@gmail.com an admin
        User::find(2)->roles()->attach(1); //Make bob@gmail.com a standard user
        User::find(3)->roles()->attach(3); //Make bossman@gmail.com an owner
        User::find(3)->roles()->attach(2); //Make bossman@gmail.com an admin
    }
}
