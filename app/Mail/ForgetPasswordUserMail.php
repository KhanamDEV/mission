<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgetPasswordUserMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;
    private $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $type = 'web')
    {
        $this->data = $data;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->type == 'mobile'){
            return $this->from(env('MAIL_FROM_ADDRESS'), 'Mission')
                ->subject('Mission パスワードの変更')
                ->view('api::mail.confirm_reset_password')
                ->with([
                    'token' => $this->data['token'],
                    'email' => $this->data['email'],
                ]);
        }
        return $this->from(env('MAIL_FROM_ADDRESS'), 'Mission')
            ->subject('Mission パスワードの変更')
            ->view('user::mail.confirm_reset_password')
            ->with([
                'token' => $this->data['token'],
                'email' => $this->data['email'],
            ]);
    }
}
