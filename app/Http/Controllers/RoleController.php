<?php

namespace App\Http\Controllers;

use App\Role;
use Response;
use Validator;
use Illuminate\Http\Request;
use App\DataTables\RolesDataTable;
use Illuminate\Support\Facades\Route;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $this->authorize('viewAny', Role::class);

    //     $roles = Role::with('users')->paginate(16);
    //     return view('users.roles.index', compact('roles'));
    // }

    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('users.roles.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('viewAny', Role::class);

        $rules = [
            'name' => 'required|unique:roles|min:2',
            'display_name' => 'required|unique:roles|min:2',
        ];

         if ($this->validator($rules)->passes()) {
            Role::create(
                $this->validator($rules)->valid()
            );

            return Response::json(['success' => '1']);
        }

        return Response::json(['errors' => $this->validator($rules)->errors()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('viewAny', Role::class);

        $rules = [
            'name' => 'required|min:2|unique:roles,name,'.$role->id,
            'display_name' => 'required|min:2|unique:roles,display_name,'.$role->id
        ];

        if ($this->validator($rules)->passes()) {
            $role->update(
                $this->validator($rules)->valid()
            );

            return Response::json(['success' => '1']);
        }

        return Response::json(['errors' => $this->validator($rules)->errors()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('viewAny', Role::class);

        $role->delete();
        return redirect(route('roles.index'))->with(['status' => 'Successfully deleted!']);
    }

    public function validator($rules)
    {
        return Validator::make(request()->all(), $rules);
    }
}
