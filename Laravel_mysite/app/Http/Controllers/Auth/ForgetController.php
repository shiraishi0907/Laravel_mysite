<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Mail\MailController;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetLoginidSendMail;
use App\Mail\ForgetPassSendMail;
use App\Models\User;

class ForgetController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */

    //これはなくてもログイン画面にリダイレクトする↓
    protected $redirectTo = RouteServiceProvider::HOME;

    //ログイン画面にリダイレクトする↓
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function forgetloginid() {
        return view('auth.forgetloginid');
    }

    public function forgetloginidcomplete(Request $request, User $user) {
        $email = $request->email;

        $request->validate([
            'email' => 'required',
        ],
        [
            'email.required' => 'Eメールアドレスは必須入力です。',
            //'email.unique' => '入力されたEメールアドレスはすでに登録されています。',
        ]);

        $loginid = $user->userModelSearch('email',$email,'loginid');

        $mail = new ForgetLoginidSendMail($request,$loginid);
        Mail::to($email)->send($mail);
        return 'sent';
    }

    public function forgetpass() {
        return view('auth.forgetpass');
    }

    public function forgetpasscomplete(Request $request) {
        $email = $request->email;

        $request->validate([
            'email' => 'required',
        ],
        [
            'email.required' => 'Eメールアドレスは必須入力です。',
            //'email.unique' => '入力されたEメールアドレスはすでに登録されています。',
        ]);

        /**
         * パスワード設定用画面のURL生成
         */
        $urls = [
            'valid' => URL::temporarySignedRoute(
                'passwd_reset.valid',
                now()->addMinutes(1),
            )
        ];

        $mail = new ForgetPassSendMail($request,$urls);
        Mail::to($email)->send($mail);
        return 'sent';
    }

    public function passwordchange() {
        return view('auth.passwordchange');
    }

    public function passwordchangecomplete() {
        return view('auth.passwordchangecomplete');
    }
}
