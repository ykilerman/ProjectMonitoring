<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin1',
            'password' => bcrypt('admin1'),
            'name' => 'Project Admin 1',
            'position' => 'Project Admin',
        ]);
        User::create([
            'username' => 'coordinator1',
            'password' => bcrypt('coordinator1'),
            'name' => 'Project Coordinator 1',
            'position' => 'Project Coordinator',
        ]);
        User::create([
            'username' => 'stakeholder1',
            'password' => bcrypt('stakeholder1'),
            'name' => 'Stakeholder 1',
            'position' => 'Stakeholder',
        ]);
        User::create([
            'username' => 'management1',
            'password' => bcrypt('management1'),
            'name' => 'Management 1',
            'position' => 'Management',
        ]);
    }
}
