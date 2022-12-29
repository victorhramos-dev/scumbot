<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordReset extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 10;

    /**
     * Password reset link
     *
     * @var  string
     */
    protected $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notifiable, $name, $link)
    {
        $this->onQueue('emails');

        $this->notifiable = $notifiable;

        $this->name = $name;

        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Recuperação de Senha');

        $data = [
            'notifiable' => $this->notifiable,
            'name'       => $this->name,
            'link'       => $this->link
        ];

        return $this->view('emails.templates.global.password-reset')->with($data);
    }
}
