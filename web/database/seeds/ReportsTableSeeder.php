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
            'project_id' => '1',
            'highlight' => 'initiate project',
            'description' => 'initiate project',
            'evidence' => 'images/evidence/projectreport1.png',
        ]);
    }
}
