<?php

namespace App\Notifications;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MaterialsFeeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private Collection $materials;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Collection $materials)
    {
        $this->materials = $materials;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        $checkBillsUrl = route('check-bills');
        return (new MailMessage)
            ->markdown('emails.materials-fee-notification', [
                'materials' => $this->materials,
                'grandTotal' => $this->materials->sum('total'),
                'checkBillsUrl' => $checkBillsUrl,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        $materials = $this->materials->map(function ($material) {
            return [
                'id' => $material['id'],
                'name' => $material['item']['name'],
                'quantity' => $material['quantity'],
                'price' => $material['unit_price'],
            ];
        });
        return [
            'request_id' => $this->materials->first()->model_id,
            'materials' => $materials,
            'message' => 'Materials fee has been updated.',
            'icon' => 'ti ti-receipt',
            'grandTotal' => $this->materials->sum('total'),
        ];
    }
}
