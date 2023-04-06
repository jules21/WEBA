<?php

namespace App\Jobs;

use App\Mail\RegisterUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailRegisteredUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $email;

    private $password;

    private $name;

    private $phone;

    public function __construct($email, $password, $name, $phone)
    {
        //
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        if ($this->attempts() < 5) {
            $message = "Welcome to WFP \n Your Password is: ".$this->password;
//            SendSms::dispatch($this->phone, $message);
            $this->sendEmail();
        }
    }

    public function sendEmail()
    {
        $data = ['name' => $this->name, 'password' => $this->password];
        try {
            Mail::to($this->email)->send(new RegisterUser($data));
        } catch (\Exception $exception) {
            info($exception);
        }
    }
}
