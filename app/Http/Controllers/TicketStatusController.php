<?php

namespace App\Http\Controllers;

use Response;
use Validator;
use App\TicketStatus;
use Illuminate\Http\Request;
use App\DataTables\TicketStatusesDataTable;

class TicketStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TicketStatus::class, 'status');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $statuses = TicketStatus::with('tickets')->paginate(10);
    //     return view('tickets.statuses.index', compact('statuses'));
    // }

    public function index(TicketStatusesDataTable $dataTable)
    {
        return $dataTable->render('tickets.statuses.index');
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
            'name' => 'required|unique:ticket_statuses|min:2',
        ]);

        if ($validator->passes()) {
            $status = TicketStatus::create([
                'name' => $request['name'],
            ]);

            return Response::json(['success' => '1']);
        }

        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TicketStatus  $ticketStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketStatus $status)
    {
        return view('tickets.statuses.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TicketStatus  $ticketStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketStatus $status)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|unique:ticket_statuses,name,'.$status->id,
        ]);

        if ($validator->passes()) {
            $status->update([
                'name' => $request['name'],
            ]);

            return Response::json(['success' => '1']);
        }

        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TicketStatus  $ticketStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketStatus $status)
    {
        $status->delete();
        return redirect(route('statuses.index'))->with(['status' => 'Successfully deleted!']);
    }
}
