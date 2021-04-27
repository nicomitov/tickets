<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Permission;
use App\Department;
use Illuminate\Http\Request;
use App\Notifications\Welcome;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Notifications\Notifiable;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    public function usersByRole(UsersDataTable $dataTable, Role $role)
    {
        $this->authorize('viewAny', User::class);

        return $dataTable->render('users.index');
    }

    public function usersByDepartment(UsersDataTable $dataTable, Department $department)
    {
        $this->authorize('viewAny', User::class);

        return $dataTable->render('users.index');
    }

    public function statUsers(UsersDataTable $dataTable, $stat)
    {
        $this->authorize('viewAny', User::class);

        return $dataTable->render('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        $selectedRoles = null;

        $departments = Department::pluck('name', 'id');
        // $selectedDepartment = null;

        return view('users.create', compact('roles', 'selectedRoles', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plainPasswd = $request->password;

        $validated = $this->validator();

        $validated['password'] = Hash::make($request->password);
        $validated['notify'] = isset($request['notify']);
        $validated['is_active'] = isset($request['is_active']);
        $validated['avatar'] = 'default.png';

        $user = User::create($validated);

        $user->createDefaultAvatar();

        $user->roles()->sync($request['toRoles']);

        // Notification
        \Notification::send($user, new Welcome($plainPasswd));

        return redirect(route('users.index'))->with(['status' => 'Successfully created!']);
    }

    public function show(User $user)
    {
        $departments = Department::pluck('name', 'id');

        return view('users.show', compact('user', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        $selectedRoles = $user->roles()->pluck('id', 'name');

        $departments = Department::pluck('name', 'id');

        return view('users.edit', compact('user', 'roles', 'selectedRoles', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $this->validator($user->id);

        $newPassword = $request['password'];

        if(empty($newPassword)) {
            $validated['password'] = $user->password;
        } else {
            $validated['password'] = Hash::make($newPassword);
        }

        $validated['notify'] = isset($request['notify']);
        $validated['is_active'] = isset($request['is_active']);

        $userName = $user->name;

        $user->update($validated);

        // check for name change and remake default avatar
        if ($userName != $validated['name'] && $user->avatar == 'default.png') {
            $user->createDefaultAvatar();
        }

        $user->roles()->sync($request['toRoles']);

        return redirect(route('users.index'))->with(['status' => 'Successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // $user->syncPermissions(null);
        // $user->syncRoles(null);

        // $user->unsubscribeFromAllThreads();

        $user->update([
            'is_active' => 0
        ]);

        $user->delete();

        return redirect(route('users.index'))->with(['status' => 'Successfully deleted!']);
    }

    public function restore($user)
    {
        $user = User::where('id', $user)->onlyTrashed()->first();
        $user->restore();

        return redirect('users')->with(['status' => 'Successfully restored!']);
    }

    protected function validator($userId = null)
    {
        $rules = [
            'name' => 'required|unique:users|min:2',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:4',
            'department_id' => 'required',
            'position' => '',
            'mobile_phone' => '',
            'work_phone' => ''
        ];

        if (Route::currentRouteName() == 'users.update') {
            $rules['name'] = 'required|min:2|unique:users,name,'.$userId;
            $rules['email'] = 'required|min:2|unique:users,email,'.$userId;
            $rules['password'] = 'nullable|min:4|confirmed';
        }

        return request()->validate($rules);
    }
}
