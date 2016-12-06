<?php

use Illuminate\Database\Seeder;
use App\MessageDetail;

class MessageDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MessageDetail::create([
            'message_id' => '1',
            'user_id' => '1',
        ]);
    }
}
