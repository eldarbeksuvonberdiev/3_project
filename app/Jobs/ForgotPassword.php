<?php

namespace App\Jobs;

use App\Mail\NewPasswordEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class ForgotPassword implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

    public $email;
    public $newPassword;
    public function __construct($email,$newPassword)
    {
        $this->email = $email;
        $this->newPassword = $newPassword;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new NewPasswordEmail($this->newPassword));
    }
}
