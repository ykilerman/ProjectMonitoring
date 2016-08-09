<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpdatingStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'description',
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
