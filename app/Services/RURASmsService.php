<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class RURASmsService
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
        return Http::withBasicAuth(config('services.rura.username'), config('services.rura.password'))
            ->asJson()
            ->post(config('services.rura.sms_url'), [
                'phone' => $this->phoneNumber,
                'message' => $this->message,
                'sender' => config('services.rura.sender_name'),
            ]);
    }
}
