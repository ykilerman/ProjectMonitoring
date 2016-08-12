<?php

use Illuminate\Database\Seeder;
use App\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'name' => 'Project 1',
            'user_id' => '1',
            'description' => 'Project 1 Seeder',
            'icon_path' => 'images/icon/project1.png',
            'client_name' => 'VDI',
            'value' => '12000000',
            'update_schedule' => '7',
        ]);
    }
}
