<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Reservation;
use Carbon\Carbon;

class AutoDeleteReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:AutoDelete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto delete nonpayment reservation after certain time';

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
     *
     * @return mixed
     */
    public function handle()
    {
        $now = new Carbon('now'); //現在時刻の取得
        $before_hour = $now->subHours(1); //現在から1時間前の取得
        $reservations = \App\Reservation::where([['created_at', '<', $before_hour], ['payment', '=', 0]])->delete();
    }
}