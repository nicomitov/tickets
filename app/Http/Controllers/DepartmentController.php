<?php

namespace App\Http\Controllers;

use Response;
use Validator;
use App\Department;
use Illuminate\Http\Request;
use App\DataTables\DepartmentsDataTable;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Department::class, 'department');
    }

    public function index(DepartmentsDataTable $dataTable)
    {
        return $dataTable->render('departments.index');
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
            'abbr' => 'required|unique:departments|min:2',
            'name' => 'required|unique:departments|min:2',
        ]);

        if ($validator->passes()) {
            $department = Department::create([
                'name' => $request['name'],
                'abbr' => $request['abbr'],
            ]);

            return Response::json(['success' => '1']);
        }

        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $validator = Validator::make($request->all(), [
            'abbr' => 'required|min:2|unique:departments,abbr,'.$department->id,
            'name' => 'required|min:2|unique:departments,name,'.$department->id,
        ]);

        if ($validator->passes()) {
            $department->update([
                'abbr' => $request['abbr'],
                'name' => $request['name'],
            ]);

            return Response::json(['success' => '1']);
        }

        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $tickets = $department->causedTickets;
        $IT_dept = Department::where('id', 1)->first();

        foreach ($tickets as $ticket) {
            $department->tickets()->detach($ticket->id);
            $IT_dept->tickets()->attach($ticket->id);
        }

        $department->delete();

        return redirect(route('departments.index'))->with(['status' => 'Successfully deleted!']);
    }
}
