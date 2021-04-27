<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    protected $fillable = ['name'];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'status_id');
    }

    public function getStatusClass()
    {
        if ($this->name == 'pending') {
            $class = 'danger';
        } elseif ($this->name == 'solved') {
            $class = 'success';
        } elseif ($this->name == 'bug') {
            $class = 'warning';
        } else {
            $class = 'secondary';
        }

        return $class;
    }
}
