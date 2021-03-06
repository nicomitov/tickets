<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketPriority extends Model
{
    protected $fillable = ['name'];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'priority_id');
    }
}
