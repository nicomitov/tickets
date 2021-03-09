<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $with = ['departments', 'status', 'category', 'priority', 'employees', 'users'];

    protected $fillable = [
        'user_id', 'priority_id', 'status_id', 'category_id', 'name', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(TicketStatus::class);
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriority::class);
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withTrashed()
                    ->withPivot('action')
                    ->withTimestamps();
    }

    public function employees()
    {
        return $this->morphedByMany('App\User', 'ticketable')->withTrashed();
    }

    public function departments()
    {
        return $this->morphedByMany('App\Department', 'ticketable');
    }

    public function getStatusClass()
    {
        if ($this->status->name == 'pending') {
            $class = 'danger';
        } elseif ($this->status->name == 'solved') {
            $class = 'success';
        } elseif ($this->status->name == 'bug') {
            $class = 'warning';
        } else {
            $class = 'secondary';
        }

        return $class;
    }

    public function employeesList($num = 1)
    {
        // make collection of employees + depts (merge() doesn't work because of same ids)
        $all = collect();
        foreach ($this->departments as $department) {
            $all->push($department);
        }

        foreach ($this->employees as $employee) {
            // change employee name (concatenate dept->name)
            // $employee->name = $employee->name . ' (' . $employee->department->name.')';
            $employee->name = $employee->name;
            $all->push($employee);
        }

        if ($all->count() > $num) {
            $shuffled = $all->shuffle();
            $display = $shuffled->take($num)->toArray();
            $more = $shuffled->slice($num)->toArray();

            foreach ($display as $displ) {
                $displayArr[] = $displ['name'];
            }

            foreach ($more as $m) {
                $moreArr[] = $m['name'];
            }

            $more = count($moreArr);

            $result = implode(', ', $displayArr) . ', <span class="small text-primary text-nowrap" style="cursor:pointer" data-toggle="popover" data-html="true" title="" data-content="'.implode(',<br> ', $moreArr).'">' . $more . ' more...</span>';
        } else {
            $result = implode(', ', $all->pluck('name')->toArray());
        }

        return $result;
    }

}
