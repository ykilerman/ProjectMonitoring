<?php

use Illuminate\Database\Seeder;
use App\Report;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Report::create([
            'project_id' => 'CU0000000001',
            'highlight' => 'initiate project',
            'activity' => 'initiate project',
            'activity_path' => 'http://localhost/ProjectMonitoring/web/storage/app/images/evidence/activity1-20160824125700.jpg',
            'income' => '0',
            'income_path' => 'http://localhost/ProjectMonitoring/web/storage/app/images/evidence/income1-20160824125700.jpg',
            'expense' => '0',
            'expense_path' => 'http://localhost/ProjectMonitoring/web/storage/app/images/evidence/expense1-20160824125700.jpg',
        ]);
    }
}
