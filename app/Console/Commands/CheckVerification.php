<?php

namespace App\Console\Commands;

use App\Models\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckVerification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-verification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $time = Carbon::now()->subSeconds(60);

        if(VerifyEmail::where('created_at','<', $time)){
            VerifyEmail::where('created_at','<', $time)->delete();
        }
    }
}
