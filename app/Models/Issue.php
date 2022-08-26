<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Issue extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    /**
     * The users that belong to the Issue
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function issueUser()
    {
        return $this->hasMany(IssueUser::class);
    }

   
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
   
   
}
