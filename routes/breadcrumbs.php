<?php

// HOME
Breadcrumbs::register('home', function ($breadcrumbs) {
     $breadcrumbs->push('', route('home'), ['icon' => 'home']);
});

// USERS
Breadcrumbs::register('users.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Users', route('users.index'));
});

Breadcrumbs::register('users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('users.index');
    $breadcrumbs->push('New', route('users.create'));
});

Breadcrumbs::register('users.edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users.index', $user);
    $breadcrumbs->push($user->name, route('users.edit', $user));
});

Breadcrumbs::register('users.by_role', function ($breadcrumbs, $role) {
    $breadcrumbs->parent('users.index');
    $breadcrumbs->push($role->name, route('users.by_role', $role));
});

Breadcrumbs::register('users.inactive', function ($breadcrumbs) {
    $breadcrumbs->parent('users.index');
    $breadcrumbs->push('Inactive', route('users.inactive'));
});

Breadcrumbs::register('users.trashed', function ($breadcrumbs) {
    $breadcrumbs->parent('users.index');
    $breadcrumbs->push('Deleted', route('users.trashed'));
});
// END USERS


Breadcrumbs::macro('resource', function ($table, $name) {
    Breadcrumbs::for("$table.index", function ($trail) use ($table, $name) {
        $trail->parent('home');
        $trail->push($name, route("$table.index"));
    });

    Breadcrumbs::for("$table.create", function ($trail) use ($table) {
        $trail->parent("$table.index");
        $trail->push('New', route("$table.create"));
    });

    Breadcrumbs::for("$table.edit", function ($trail, $model) use ($table) {
        $trail->parent("$table.index", $model);
        $trail->push($model->name, route("$table.edit", $model));
    });

    Breadcrumbs::for("$table.show", function ($trail, $model) use ($table) {
        $trail->parent("$table.index", $model);
        $trail->push($model->name, route("$table.show", $model));
    });
});

Breadcrumbs::resource('roles', 'Site Modules');
Breadcrumbs::resource('departments', 'Departments');
Breadcrumbs::resource('tickets', 'Tickets');


Breadcrumbs::macro('resource1', function ($table, $name) {
    Breadcrumbs::for("$table.index", function ($trail) use ($table, $name) {
        $trail->parent('tickets.index');
        $trail->push($name, route("$table.index"));
    });
});
Breadcrumbs::resource1('tickets.categories', 'Categories');
Breadcrumbs::resource1('tickets.statuses', 'Statuses');
Breadcrumbs::resource1('tickets.priorities', 'Priorities');

// TICKETS
Breadcrumbs::register('tickets.user', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('tickets.index');
    $breadcrumbs->push($user->name, route('tickets.user', $user));
});

Breadcrumbs::register('tickets.employee', function ($breadcrumbs, $employee) {
    $breadcrumbs->parent('tickets.index');
    $breadcrumbs->push($employee->name, route('tickets.employee', $employee));
});

Breadcrumbs::register('tickets.department', function ($breadcrumbs, $department) {
    $breadcrumbs->parent('tickets.index');
    $breadcrumbs->push($department->name, route('tickets.department', $department));
});

Breadcrumbs::register('tickets.status', function ($breadcrumbs, $status) {
    $breadcrumbs->parent('tickets.index');
    $breadcrumbs->push($status->name, route('tickets.status', $status->name));
});

Breadcrumbs::register('tickets.category', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('tickets.index');
    $breadcrumbs->push($category->name, route('tickets.category', $category->name));
});

Breadcrumbs::register('tickets.priority', function ($breadcrumbs, $priority) {
    $breadcrumbs->parent('tickets.index');
    $breadcrumbs->push($priority->name, route('tickets.priority', $priority->name));
});
// END TICKETS

// NOTIFICATIONS
Breadcrumbs::register('notifications.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Notifications', route('notifications.index'));
});
