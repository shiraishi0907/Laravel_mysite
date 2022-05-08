<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPassSendMail extends Mailable {

    use Queueable, SerializesModels;

    public function __construct($request, $urls) {
        $this->request = $request;
        $this->urls = $urls;
    }

    public function build() {
        return $this
            ->subject('さんからメールが届きました')
            ->view('mail.forgetpassview')
            ->with([
                'urls' => $this->urls,
            ]);
    }
}