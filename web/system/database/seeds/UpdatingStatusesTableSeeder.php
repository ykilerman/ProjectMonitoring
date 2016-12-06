<?php

use Illuminate\Database\Seeder;
use App\UpdatingStatus;

class UpdatingStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UpdatingStatus::create([
            'project_id' => '1',
            'highlight' => 'Closing Project',
            'description' => 'Project is cleared',
        ]);
    }
}
