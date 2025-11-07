<?php

namespace App\Jobs;

use App\Mail\SendOtpMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendOtpJob implements ShouldQueue
{
    use Queueable;


    protected $email;
    protected $otp;
    /**
     * Create a new job instance.
     */
    public function __construct(string $email, string $otp)
    {
        $this->email = $email;
        $this->otp = $otp;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mailable = new SendOtpMail($this->otp);
        Mail::to($this->email)->send($mailable);
    }
}
