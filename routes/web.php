<?php

// LANG
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

// VERIFICATION
Auth::routes(['verify' => true]);

// REGISTRATION
if (!env('ALLOW_REGISTRATION', false)) {
    Route::any('/register', function() {
        return redirect('/');
    });
}

// MIDDLEWARE VERIFIED
Route::middleware(['verified'])->group(function () {

    // HOME
    Route::get('/', 'HomeController@index')->name('home');

    // DEPARTMENTS
    Route::resource('departments', 'DepartmentController', [
        'except' => ['show', 'create', 'edit']
    ]);

    // TICKETS
    Route::name('tickets.')->group(function () {
        Route::prefix('tickets/')->group(function () {
            Route::resource('categories', 'TicketCategoryController', [
                'except' => ['show', 'create', 'edit'],
            ]);
            Route::resource('priorities', 'TicketPriorityController', [
                'except' => ['show', 'create', 'edit']
            ]);
            Route::resource('statuses', 'TicketStatusController', [
                'except' => ['show', 'create', 'edit']
            ]);

            Route::get('status/{status}', 'TicketController@status')
                ->name('status');

            Route::get('category/{category}', 'TicketController@category')
                ->name('category');

            Route::get('priority/{priority}', 'TicketController@priority')
                ->name('priority');

            Route::get('{ticket}/status_change/{status}', 'TicketController@statusChange')
                ->name('status_change');
        });

        Route::get('tickets/users/{user}', 'TicketController@userTickets')
            ->name('user');

        Route::get('tickets/employee/{employee}', 'TicketController@employeeTickets')
            ->name('employee');

        Route::get('tickets/department/{department}', 'TicketController@departmentTickets')
            ->name('department');
    });

    Route::resource('tickets', 'TicketController');
    // END TICKETS

    // ROLES
    Route::resource('roles', 'RoleController', [
        'except' => ['create', 'show', 'edit']
    ]);
    // ROLES END

    // USERS
    Route::name('users.')->group(function () {
        Route::prefix('users/')->group(function () {
            Route::get('role/{role}', 'UserController@usersByRole')
                ->name('by_role');
            Route::get('stat/{stat}', 'UserController@statUsers')
                ->name('stat');
            Route::delete('{user}/restore', 'UserController@restore')
                ->name('restore');
            Route::get('department/{department}', 'UserController@usersByDepartment')
            ->name('department');
        });
    });

    Route::resource('users', 'UserController');
    // USERS END

    // notifications
    Route::get('notifications', 'NotificationController@index')
        ->name('notifications.index');
    Route::get('notifications/{notification}', 'NotificationController@show')
        ->name('notifications.show');
    Route::delete('notifications/{notification}/read', 'NotificationController@read')
        ->name('notifications.read');
    Route::delete('notifications/read', 'NotificationController@markAllAsRead')
        ->name('notifications.read_all');
    Route::delete('notifications/delete', 'NotificationController@deleteAll')
        ->name('notifications.delete_all');
    Route::delete('notifications/{notification}', 'NotificationController@destroy')
        ->name('notifications.destroy');

}); // END MIDDLEWARE VERIFIED
