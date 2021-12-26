<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Reservation;

class AutoDeleteCompletedReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:AutoDeleteCompletedReservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Delete Completed Reservations after users reserved time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /**
         * 現在時刻の取得
         * 
         * @var string 現在の時刻取得
         */
        $now = new Carbon('now');

        /**
         * 予約終了日時が現在日時と一致した場合、予約を削除
         * 
         */
        $reservations = \App\Reservation::where('end_at', '=', $now)->delete();
    }
}
