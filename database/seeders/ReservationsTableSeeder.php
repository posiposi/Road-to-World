<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = new Carbon('now');
        for ($i=1; $i<=3; $i++) {
            $reservation = [
                'user_id' => 2,
                'bike_id' => 1,
                'start_at' => $time,
                'end_at' => $time->addHours($i),
                'created_at' => now(),
                'updated_at' => now(),
                'payment' => 1,
            ];
            \Illuminate\Support\Facades\DB::table('reservations')->insert($reservation);
        }
    }
}
