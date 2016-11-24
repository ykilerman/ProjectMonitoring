<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'project_id', 'text',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function answer()
    {
        return $this->hasMany('App\Answer');
    }
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
