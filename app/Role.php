<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     protected $fillable = [
        'name', 'display_name', 'description'
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function users()
    {
        return $this->belongsToMany(User::Class);
    }

    public function activeUsers()
    {
        return $this->users()
                    ->where('deleted_at', NULL)
                    ->where('is_active', 1);
    }
}
