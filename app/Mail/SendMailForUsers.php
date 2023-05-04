<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailForUsers extends Mailable
{
    use Queueable, SerializesModels;

    public $mess;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mess,$id)
    {
        $this->mess = $mess;
        $this->id=$id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.emailSenders',['title'=>$this->mess, 'id'=>$this->id])->subject("Уведомление");
    }
}
