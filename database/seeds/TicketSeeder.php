<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'general',
            'hardware',
            'software',
        ];

        $priorities = [
            'normal',
            'low',
            'critical',
        ];

        $statuses = [
            'pending',
            'solved',
            'bug',
            'outdated',
        ];

        foreach ($categories as $name) {
            DB::table('ticket_categories')->insert([
                'name' => $name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach ($priorities as $name) {
            DB::table('ticket_priorities')->insert([
                'name' => $name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach ($statuses as $name) {
            DB::table('ticket_statuses')->insert([
                'name' => $name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
