<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'subject', 'message', 'read',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function messageDetail()
    {
        return $this->hasMany('App\MessageDetail');
    }
}
