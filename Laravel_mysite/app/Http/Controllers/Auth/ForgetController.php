<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Mail\MailController;
use App\Http\Requests\ForgetRequest;


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

    /**
     * リクエストを受けた時のハッシュ値とリクエスト時間を足した値をハッシュ化し直しているので
     * リクエスト時間がずれる(ページ更新したりなど)と、ハッシュが不正されたとみなす
     */
    protected function passRehash($data) {
        $crypt = crypt($data,'$5$rounds=30000$7VRXjNsd93fsy9ci58C1xKu1');
        return hash_equals($crypt,crypt($data,$crypt));
    }

    public function forgetloginid() {
        return view('auth.forgetloginid');
    }

    public function forgetloginidcomplete(Request $request, ForgetRequest $forgetrequest) {
        $isvalid = array(
            'request' => $forgetrequest,
        );
        $nickname = $request->name;
        $mail = new MailController;
        $mail->mail('loginid',$nickname,NULL,NULL);
        return view('auth.forgetloginidcomplete')->with($isvalid);
    }

    public function forgetpass() {
        return view('auth.forgetpass');
    }

    public function forgetpasscomplete(Request $request) {
        $email = $request->email;
        $mail = new MailController;
        $mail->mail('passreset',NULL,$email,NULL);
        return view('auth.forgetpasscomplete',compact('email'));
    }

    public function passwordreset($timestamp,$hash) {
        $clickTime = time(); 
        $clickTime = (string) $clickTime;

        $data = $timestamp;
        $data .= $hash;

        if ($this->passRehash($data)) { //ハッシュが不正なものでないか？
            if (($clickTime - $timestamp) < 60 * 5) { //5分経ってないか
                return view('auth.passwordreset'); //パスワード設定画面に遷移
            } else {
                return redirect('/passwd_reset'); //パスワード設定申請画面にリダイレクト
            }
        } else {
            return redirect('/passwd_reset'); //パスワード設定申請画面にリダイレクト
        }
    }

    public function passwordchange() {
        return view('auth.passwordchange');
    }

    public function passwordchangecomplete() {
        return view('auth.passwordchangecomplete');
    }
}
