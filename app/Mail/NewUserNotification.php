<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $email;
    public $company;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $company)
    {
        $this->name = $name;
        $this->email = $email;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->email) {
            return $this->subject('Welcome to 360Smartersearch')->view('emails.census');
        } else {
            return $this->subject('Welcome to 360Smartersearch')->view('emails.newuser');
        }
    }
}
