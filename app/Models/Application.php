<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'project_role_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projectRole()
    {
        return $this->belongsTo(ProjectRole::class);
    }
}
