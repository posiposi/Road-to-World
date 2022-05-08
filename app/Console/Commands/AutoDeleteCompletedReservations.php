<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Reservation;
use Carbon\Carbon;

class AutoDeleteCompletedReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:AutoDeleteClosedReservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto delete completed reservations after users reserved time';

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
         * @property \Illuminate\Support\Carbon $now 現在の時刻取得
         */
        $now = new Carbon('now');

        /**
         * 現在以前の予約を削除
         */
        $reservations = \App\Reservation::where('end_at', '<=', $now)->delete();
    }
}
