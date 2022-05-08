<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetLoginidSendMail extends Mailable {

    use Queueable, SerializesModels;

    public function __construct($request,$loginid) {
        $this->request = $request;
        $this->request = $loginid;
    }

    public function build() {
        return $this
            ->subject('さんからメールが届きました')
            ->view('mail.forgetloginidview')
            ->with([
                'loginid' => $this->loginid,
            ]);
    }
}