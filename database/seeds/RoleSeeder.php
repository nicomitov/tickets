<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin' => 'Administrator',
            'tickets' => 'Tickets',
            'ticket-categories' => 'Ticket-categories',
            'ticket-priorities' => 'Ticket-priorities',
            'ticket-statuses' => 'Ticket-statuses',
            'departments' => 'Departments',
            'users' => 'Users',
            'roles' => 'Roles',
        ];

        foreach ($roles as $name => $displayName) {
            DB::table('roles')->insert([
                'name' => $name,
                'display_name' => $displayName,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
