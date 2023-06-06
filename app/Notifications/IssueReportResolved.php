<?php

namespace App\Notifications;

use App\Models\IssueReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class IssueReportResolved implements ShouldQueue
{
    use Queueable;

    /**
     * @var IssueReport
     */
    private IssueReport $issueReport;

    /**
     * @param IssueReport $issueReport
     */
    public function __construct(IssueReport $issueReport)
    {
        $this->issueReport = $issueReport;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array|string[]
     */
    public function via($notifiable): array
    {
        return ['mail', 'database'];
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
            'title' => 'Issue Report Resolved',
            'message' => "Issue Report {$this->issueReport->title} has been resolved",
            'url' => route('client.issues-reported')
        ];
    }


    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     */

    public function toMail($notifiable): MailMessage
    {
        $url = route('client.issues-reported');
        $message = "Issue Report '{$this->issueReport->title}' has been resolved";
        return (new MailMessage)
            ->subject('Issue Report Resolved')
            ->greeting('Hello!')
            ->line($message)
            ->action('View Issue Report', $url)
            ->line('Thank you for using our application!');
    }
}
