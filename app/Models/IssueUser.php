<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IssueUser extends Model
{
    use HasFactory;
    protected $table='issue_user';
    protected $guarded = ['id'];

    public function Issues(){
        return $this->hasMany(Issue::class,'id');
    }
    
}
