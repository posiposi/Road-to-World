<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $start_time = CarbonImmutable::now();
        $reservation = [
            'user_id' => 2,
            'bike_id' => 1,
            'start_at' => $start_time,
            'end_at' => $start_time->addMinutes(30),
            'created_at' => now(),
            'updated_at' => now(),
            'payment' => 1,
        ];
        \Illuminate\Support\Facades\DB::table('reservations')->insert($reservation);
    }
}
