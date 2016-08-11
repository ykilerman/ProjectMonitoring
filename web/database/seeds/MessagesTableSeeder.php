<?php

use Illuminate\Database\Seeder;
use App\Message;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::create([
            'user_id' => '1',
            'subject' => 'Message Seeder',
            'message' => 'This is a message table seeder.',
        ]);
    }
}
