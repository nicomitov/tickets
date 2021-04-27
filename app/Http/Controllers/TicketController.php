<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Ticket;
use Carbon\Carbon;
use App\Department;
use App\TicketStatus;
use App\TicketCategory;
use App\TicketPriority;
use Illuminate\Http\Request;
use App\DataTables\TicketsDataTable;
use App\Notifications\TicketNotification;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Ticket::class, 'ticket');
    }

     public function index(TicketsDataTable $dataTable)
    {
        return $dataTable->render('tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selected = [];
        $statuses = TicketStatus::orderBy('id')->pluck('name', 'id');
        $priorities = TicketPriority::orderBy('id')->pluck('name', 'id');
        $categories = TicketCategory::orderBy('id')->pluck('name', 'id');

        $employees = User::orderBy('name')->with('department')->get();
        $departments = Department::orderBy('name')->get();

        // create array for employees
        foreach ($employees as $employee) {
            $emp[] = [
                'id' => $employee->id . '_employee',
                'name' => $employee->name .' ('. $employee->department->name .')'
            ];
        }

        // create array for departments
        foreach ($departments as $department) {
            $dep[] = [
                'id' => $department->id . '_department',
                'name' => $department->name
            ];
        }

        // merge arrays for employees & departments
        $emp = array_merge($dep, $emp);

        return view('tickets.create', compact('selected', 'statuses', 'priorities', 'categories', 'emp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'status_id' => 'required',
            'priority_id' => 'required',
            'category_id' => 'required',
            'toEmployees' => 'required',
        ]);

        $request['user_id'] = auth()->user()->id;

        $ticket = Ticket::create($request->all());

        // attach model tickets
        $all = collect();
        foreach ($request['toEmployees'] as $employee) {
            $pieces = explode("_", $employee);

            if ($pieces[1] == 'employee') {
                $model = User::find($pieces[0]);
            } elseif ($pieces[1] == 'department') {
                $model = Department::find($pieces[0]);
            }
            $all->push($model);

            $model->causedTickets()->attach($ticket->id);
        }

        // attach ticket_user pivot data
        $ticket->users()->attach(auth()->user()->id, ['action' => 'created ticket']);

        // Notifications
        $notify_users = Role::where('name', 'admin')->first()->activeUsers()->get()
                            ->filter(function($user) {
                                return $user->id != auth()->user()->id;
                            });

        \Notification::send($notify_users, new TicketNotification($ticket));
        \Notification::route('mail', env('MAIL_FOR_TICKETS'))
            ->notify(new TicketNotification($ticket));

        return redirect(route('tickets.index'))->with(['status' => 'Successfully created!']);
    }

    public function show(Ticket $ticket)
    {
        $statuses = TicketStatus::orderBy('id')->pluck('name', 'id');

        return view('tickets.show', compact('ticket', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        // $selected = $ticket->employees->pluck('id')->toArray();
        $statuses = TicketStatus::orderBy('id')->pluck('name', 'id');
        $priorities = TicketPriority::orderBy('id')->pluck('name', 'id');
        $categories = TicketCategory::orderBy('id')->pluck('name', 'id');

        $employees = User::orderBy('name')->with('department')->get();
        $departments = Department::orderBy('name')->get();

        // create array for all employees & departments
        foreach ($employees as $employee) {
            $emp[] = [
                'id' => $employee->id . '_employee',
                'name' => $employee->name .' ('. $employee->department->name .')'
            ];
        }

        foreach ($departments as $department) {
            $dep[] = [
                'id' => $department->id . '_department',
                'name' => $department->name,
            ];
        }
        $emp = array_merge($dep, $emp);

        // create array for selected employees & departments
        if ($ticket->employees->count() != 0) {
            foreach ($ticket->employees as $sel_employee) {
                $sel_emp[] = [
                    'id' => $sel_employee->id,
                    'name' => $sel_employee->name .' ('. $sel_employee->department->name .')'
                ];
            }
        } else {
            $sel_emp = [];
        }

        if ($ticket->departments->count() != 0) {
            foreach ($ticket->departments as $sel_department) {
                $sel_dep[] = [
                    'id' => $sel_department->id,
                    'name' => $sel_department->name,
                ];
            }
        } else {
            $sel_dep = [];
        }

        $selected = array_merge($sel_emp, $sel_dep);

        return view('tickets.edit', compact('ticket', 'statuses', 'priorities', 'categories', 'emp', 'selected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'status_id' => 'required',
            'priority_id' => 'required',
            'category_id' => 'required',
            'toEmployees' => 'required'
        ]);

        $status = TicketStatus::find($request['status_id']);

        // attach user_id
        $user_id = auth()->user()->id;

        if ($request['status_id'] == $ticket->status_id) {
            $action = 'updated ticket';
            $ticket->update($request->all());
        } else {
            $ticket->update($request->all());
            $action = 'updated status to <span class="badge badge-'.$ticket->getStatusClass().'">'.$status->name.'</span>';
        }
        $ticket->users()->attach($user_id, ['action' => $action]);

        // create arrays for employees and departments
        $empl = [];
        $dep = [];
        $all = collect();
        foreach ($request['toEmployees'] as $employee) {
            $pieces = explode("_", $employee);

            if ($pieces[1] == 'employee') {
                $empl[] = $pieces[0];
                $model = User::find($pieces[0]);
            } elseif ($pieces[1] == 'department') {
                $dep[] = $pieces[0];
                $model = Department::find($pieces[0]);
            }
            $all->push($model);
        }

        // sync employees and departments
        $ticket->employees()->sync($empl);
        $ticket->departments()->sync($dep);

        // Notifications
        $notify_users = Role::where('name', 'admin')->first()->activeUsers()->get()
                            ->filter(function($user) {
                                return $user->id != auth()->user()->id;
                            });

        \Notification::send($notify_users, new TicketNotification($ticket));
        \Notification::route('mail', env('MAIL_FOR_TICKETS'))
            ->notify(new TicketNotification($ticket));

        return redirect(route('tickets.index'))->with(['status' => 'Successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        $ticket->employees()->detach();
        $ticket->departments()->detach();
        $ticket->users()->detach();

        return redirect(route('tickets.index'))->with(['status' => 'Successfully deleted!']);
    }

    public function userTickets(TicketsDataTable $dataTable, User $user)
    {
        $this->authorize('viewAny', Ticket::class);

        return $dataTable->render('tickets.index');
    }

    public function employeeTickets(TicketsDataTable $dataTable, User $employee)
    {
        $this->authorize('viewAny', Ticket::class);

        return $dataTable->render('tickets.index');
    }

    public function departmentTickets(TicketsDataTable $dataTable, Department $department)
    {
        $this->authorize('viewAny', Ticket::class);

        return $dataTable->render('tickets.index');
    }

    public function status(TicketsDataTable $dataTable, TicketStatus $status)
    {
        $this->authorize('viewAny', Ticket::class);

        return $dataTable->render('tickets.index');
    }

    public function category(TicketsDataTable $dataTable, TicketCategory $category)
    {
        $this->authorize('viewAny', Ticket::class);

        return $dataTable->render('tickets.index');
    }

    public function priority(TicketsDataTable $dataTable, TicketPriority $priority)
    {
        $this->authorize('viewAny', Ticket::class);

        return $dataTable->render('tickets.index');
    }

    public function statusChange(Ticket $ticket, TicketStatus $status)
    {
        $this->authorize('update', $ticket);

        // attach user_id
        $user_id = auth()->user()->id;

        $ticket->update(['status_id' => $status->id]);


        $ticket->users()->attach($user_id, ['action' => 'updated status to <span class="badge badge-'.$status->getStatusClass().'">'.$status->name.'</span>']);

        // Notifications
        $notify_users = Role::where('name', 'admin')->first()->activeUsers()->get()
                            ->filter(function($user) {
                                return $user->id != auth()->user()->id;
                            });

        \Notification::send($notify_users, new TicketNotification($ticket));
        \Notification::route('mail', env('MAIL_FOR_TICKETS'))
            ->notify(new TicketNotification($ticket));

        return redirect(route('tickets.index'))->with(['status' => 'Successfully updated!']);
    }
}
