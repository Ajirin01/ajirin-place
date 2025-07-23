<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPreOrderAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $preOrder;

    /**
     * Create a new message instance.
     */
    public function __construct($preOrder)
    {
        $this->preOrder = $preOrder;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Pre-order Received')
                    ->view('emails.preorder.alert')
                    ->with(['preOrder' => $this->preOrder]);
    }
}
