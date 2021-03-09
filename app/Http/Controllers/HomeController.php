<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use Carbon\Carbon;
use App\Department;
use App\TicketStatus;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // tickets
        $all_tickets = Ticket::all()->sortByDesc('created_at');
        $pending_tickets = $all_tickets->where('status_id', 1);
        $solved_tickets = $all_tickets->where('status_id', 2);
        $outdated_tickets = $all_tickets->where('status_id', 4);

        if ($all_tickets->count()) {
            $pending_tickets_perc = round($pending_tickets->count() * 100 / $all_tickets->count());
            $solved_tickets_perc = round($solved_tickets->count() * 100 / $all_tickets->count());
            $outdated_tickets_perc = round($outdated_tickets->count() * 100 / $all_tickets->count());
        } else {
            $pending_tickets_perc = 0;
            $solved_tickets_perc = 0;
            $outdated_tickets_perc = 0;
        }


        // employees
        $employees_count = User::all()->count();
        $departments_count = Department::all()->count();

        // tickets chart
        $empl = User::whereHas('causedTickets')
            ->withCount('causedTickets')
            ->orderBy('caused_tickets_count', 'desc')
            ->get();

        if ($empl->count() > 0) {
            foreach ($empl as $e) {
                // $arr = explode(' ', $e->name);
                // $label = $arr[0] . $e->department->name;
                $label = $e->name;
                $value = $e->caused_tickets_count;

                $data_tick[] = [
                    'label' => $label,
                    'value' => $value
                ];
            }
            $data_tickets = json_encode($data_tick);
        } else {
            $data_tickets = null;
        }


        return view('dashboard.home', compact('all_tickets', 'pending_tickets', 'solved_tickets', 'solved_tickets_perc', 'pending_tickets_perc', 'outdated_tickets', 'outdated_tickets_perc', 'employees_count', 'departments_count', 'data_tickets'));
    }
}
