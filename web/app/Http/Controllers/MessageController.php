<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\MessageDetail;
use App\Http\Requests;
use Auth;

class MessageController extends Controller
{
    public function getIndex()
    {
        return view('message.inbox');
    }
    public function getListinbox()
    {
        $messages = MessageDetail::where('user_id',Auth::user()->id)
            ->paginate(6);
        $total = MessageDetail::where('user_id',Auth::user()->id)
            ->count();
        return view('message.inboxList')->with('messages',$messages)->with('total',$total);
    }
    public function getOutbox()
    {
        return view('message.outbox');
    }
    public function getListoutbox()
    {
        $messages = Message::where('user_id',Auth::user()->id)
            ->paginate(6);
        $total = Message::where('user_id',Auth::user()->id)
            ->count();
        return view('message.outboxList')->with('messages',$messages)->with('total',$total);
    }
}
