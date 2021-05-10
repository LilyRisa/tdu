<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public $mailbody;

    public function __construct($data, $mailbody)
    {
        $this->data = $data;
        $this->mailbody = $mailbody;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.account_verify')->with([
            'name' => $this->data->fullname,
            'chucvu' => $this->data->chucvu->name,
            'phongban' => $this->data->phongban->name,
            'title' => $this->mailbody['title'],
            'body' => $this->mailbody['body'],
            'image' => $this->mailbody['image'],
        ]);
    }
}
