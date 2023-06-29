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
    public $contactPersonName;
    public $contactPersonEmail;
    public $fromDate;

    public $type;
    /**
     * Create a new message instance.
     *
     * @return void
     */


    public function __construct( $days,$fromDate,$validTo,$contactPersonEmail, $contactPersonName, $type)
    {
        $this->days=$days;
        $this->fromDate=$fromDate;
        $this->validTo=$validTo->format('Y-m-d');
        $this->contactPersonName=$contactPersonName;
        $this->contactPersonEmail=$contactPersonEmail;
        $this->type = $type;
//        dd($days);
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
            ->markdown('admin.area-of-operation.grace_periods.email.index');
    }
}
