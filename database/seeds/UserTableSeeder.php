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
            ['id' => '1', 'name' => 'master', 'email' => "master@gmail.com", 'password' => bcrypt('password'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );
        DB::table('users')->insert($users);

        //Attach user roles
        User::find(1)->roles()->attach(3); //Make master@gmail.com an owner
    }
}
