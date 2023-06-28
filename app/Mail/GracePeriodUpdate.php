<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GracePeriodUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $days;
    public $validTo;
    public $contactPerson;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $days,$validTo,$contactPerson)
    {
        $this->days=$days;
        $this->validTo=$validTo;
        $this->validTo=$contactPerson;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this
            ->subject('Grace Period and Validity Update')
            ->view('admin.area-of-operation.grace_periods.email.index');
    }
}
