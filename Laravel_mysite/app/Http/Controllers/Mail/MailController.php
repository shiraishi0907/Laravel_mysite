<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function forgetpassmailvalid(Request $request) {
        // URLの有効期限が切れた場合と不正なURLの場合
        if (!$request->hasValidSignature()) {
            return redirect()->route('passwd_reset.invalid');
        }
        return 'valid';
    }

    public function forgetpassmailinvalid() {
        return 'invalid';
    }

}
