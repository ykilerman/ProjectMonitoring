<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageDetail extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message_id', 'room', 'user_id', 'asread',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function message()
    {
        return $this->belongsTo('App\Message');
    }
}
