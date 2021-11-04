<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Reservation;

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
        $reservation = \App\Reservation::where('payment', '==', 0)->get(); //未決済の予約を取得
        $reservation->delete();
    }
}
