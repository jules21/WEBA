<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class BesoftSmsService
{
    private string $phoneNumber;
    private string $message;

    public function __construct($phoneNumber, $message)
    {
        $this->phoneNumber = $phoneNumber;
        $this->message = $message;
    }

    public function sendSms(): Response
    {
        return Http::post(config('services.besoft.sms_url'), [
            "token" => config('services.besoft.token'),
            "phone" => $this->phoneNumber,
            "message" => $this->message,
            "sender_name" => config('services.besoft.sender_name')
        ]);

    }
}
