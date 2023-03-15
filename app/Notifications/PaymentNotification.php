<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Services\BesoftSmsService;
use App\Services\RURASmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentNotification extends Notification implements ShouldQueue
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
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail', 'database', SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hello!')
            ->line($this->message)
//            ->action('View Invoice', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'message' => $this->message,
            'url' => url('/'),
            'type' => 'payment',
            'icon' => 'fas fa-money-bill-wave',
            'amount' => 0,
            'request_id' => 0,
        ];
    }

    public function toSms($notifiable): BesoftSmsService
    {
        $message = $this->message;
        $phone = $notifiable->phone;
        return (new BesoftSmsService($phone, $message));
    }

}
