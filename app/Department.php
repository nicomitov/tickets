<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [ 'abbr', 'name' ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function causedTickets()
    {
        return $this->morphToMany('App\Ticket', 'ticketable');
    }
}
