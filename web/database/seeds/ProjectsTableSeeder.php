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
            'user_id' => '2',
            'type' => 'Consultation',
            'description' => 'Project 1 Seeder',
            'icon_path' => 'http://localhost/ProjectMonitoring/web/storage/app/images/icon/project1-20160823100135.jpg',
            'client_name' => 'VDI',
            'value' => '12000000',
            'update_schedule' => '7',
        ]);
        Project::create([
            'name' => 'Project 2',
            'user_id' => '2',
            'type' => 'Consultation',
            'description' => 'Project 2 Seeder',
            'icon_path' => 'http://localhost/ProjectMonitoring/web/storage/app/images/icon/project2-20160823100135.jpg',
            'client_name' => 'VDI',
            'value' => '12000000',
            'update_schedule' => '7',
            'status' => 'Deleted',
        ]);
        Project::create([
            'name' => 'Project 3',
            'user_id' => '2',
            'type' => 'Procurement',
            'description' => 'Project 3 Seeder',
            'icon_path' => 'http://localhost/ProjectMonitoring/web/storage/app/images/icon/project3-20160823100135.jpg',
            'client_name' => 'VDI',
            'value' => '12000000',
            'update_schedule' => '7',
            'status' => 'Closed',
        ]);
        Project::create([
            'name' => 'Project 4',
            'user_id' => '2',
            'type' => 'Consultation and Procurement',
            'description' => 'Project 4 Seeder',
            'icon_path' => 'http://localhost/ProjectMonitoring/web/storage/app/images/icon/project4-20160823100135.jpg',
            'client_name' => 'VDI',
            'value' => '12000000',
            'update_schedule' => '7',
            'status' => 'Archived',
        ]);
    }
}
