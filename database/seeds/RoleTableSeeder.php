<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            ['id' => '1', 'name' => 'member', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => '2', 'name' => 'admin', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => '3', 'name' => 'owner', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => '4', 'name' => 'banned', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );

        DB::table('roles')->insert($roles);//
    }
}
