<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'user_id', 'description', 'icon_path', 'client_name', 'value', 'update_schedule', 'last_notification', 'status', 'percent', 'type',
    ];

    public function report()
    {
        return $this->hasMany('App\Report');
    }
    public function updatingStatus()
    {
        return $This->hasOne('App\UpdatingStatus');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
