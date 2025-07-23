<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PreOrderConfirmation extends Mailable
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
        return $this->subject('Your Pre-order Confirmation')
                    ->view('emails.preorder.confirmation')
                    ->with(['preOrder' => $this->preOrder]);
    }
}
