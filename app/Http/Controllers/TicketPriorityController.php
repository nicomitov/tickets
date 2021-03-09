<?php

namespace App\Http\Controllers;

use Response;
use Validator;
use App\TicketPriority;
use Illuminate\Http\Request;
use App\DataTables\TicketPrioritiesDataTable;

class TicketPriorityController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TicketPriority::class, 'priority');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $priorities = TicketPriority::with('tickets')->paginate(10);
    //     return view('tickets.priorities.index', compact('priorities'));
    // }

    public function index(TicketPrioritiesDataTable $dataTable)
    {
        return $dataTable->render('tickets.priorities.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:ticket_priorities|min:2',
        ]);

        if ($validator->passes()) {
            $priority = TicketPriority::create([
                'name' => $request['name'],
            ]);

            return Response::json(['success' => '1']);
        }

        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TicketPriority  $ticketPriority
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketPriority $priority)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|unique:ticket_priorities,name,'.$priority->id,
        ]);

        if ($validator->passes()) {
            $priority->update([
                'name' => $request['name'],
            ]);

            return Response::json(['success' => '1']);
        }

        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TicketPriority  $ticketPriority
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketPriority $priority)
    {
        $priority->delete();
        return redirect(route('priorities.index'))->with(['status' => 'Successfully deleted!']);
    }
}
