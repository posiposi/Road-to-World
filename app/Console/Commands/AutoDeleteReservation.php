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
         * 現在から1時間前の時刻取得
         * 
         * @property \Illuminate\Support\Carbon $before_hour 1時間前の時刻
         */
        $before_hour = $now->subHours(1);
        
        /**
         * 1時間前かつ未決済の予約を削除
         * 
         */
        $reservations = \App\Reservation::where([['created_at', '<', $before_hour], ['payment', '=', 0]])->delete();
    }
}