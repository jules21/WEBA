<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Services\BesoftSmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SmsNotification extends Notification implements ShouldQueue
{
    use Queueable;
    private string $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return [SmsChannel::class];
    }

    public function toSms($notifiable): BesoftSmsService
    {
        $message = $this->message;
        $phone = $notifiable->phone;

        return new BesoftSmsService($phone, $message);
    }
}
