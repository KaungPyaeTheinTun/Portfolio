<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ContactMail extends Mailable
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject("New Contact Message")
                    ->replyTo($this->data['email'], $this->data['name'])
                    ->view('emails.contact');
    }
}