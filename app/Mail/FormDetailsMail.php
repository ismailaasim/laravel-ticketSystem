<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FormDetailsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $subject;
    public $ccAddresses;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $subject, $ccAddresses = [])
    {
        $this->details = $details;
        $this->subject = $subject;
        $this->ccAddresses = $ccAddresses;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.formdetails',
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('emails.formdetails')
            ->subject($this->subject);

        if (!empty($this->ccAddresses)) {
            $email->cc($this->ccAddresses);
        }

        return $email;
    }
}
