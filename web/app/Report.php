<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'highlight', 'activity', 'activity_path', 'income', 'income_path', 'expense', 'expense_path',
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['project'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
