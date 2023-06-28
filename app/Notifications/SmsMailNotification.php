<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Services\BesoftSmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SmsMailNotification extends Notification implements ShouldQueue
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
     */
    public function via($notifiable): array
    {
        return ['mail', SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hello!')
            ->line($this->message)
//            ->action('View Invoice', url('/'))
            ->line('Thank you for using our application!');
    }


    public function toSms($notifiable): BesoftSmsService
    {
        $message = $this->message;
        $phone = $notifiable->phone;

        return new BesoftSmsService($phone, $message);
    }
}
