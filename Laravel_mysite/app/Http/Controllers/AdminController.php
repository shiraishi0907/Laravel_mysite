<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Mail\MailController;
use App\Mail\AdminAuthPageSendMail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use PragmaRX\Google2FA\Google2FA;

class AdminController extends Controller
{
    public function adminregister(Request $request, User $user) {
        // URLの有効期限が切れた場合と不正なURLの場合
        if (!$request->hasValidSignature()) {
            return redirect()->route('invalidlink');
        }
        $userdata['loginid'] = $user->userModelSearch('user_value_id',2,'loginid');
        $userdata['nickname'] = $user->userModelSearch('user_value_id',2,'nickname');
        $userdata['email'] = $user->userModelSearch('user_value_id',2,'email');
        return view('admin.adminregister',compact('userdata'));
    }

    public function adminpage() {
        return view('admin.adminpage');
    }

    public function adminlink() {
        return view('admin.adminlink');
    }

    //管理者権限付与ページにモーダルで送信完了文言を表示
    public function adminlinkcomplete(Request $request) {
        $email = $request->email;

        $request->validate([
            'email' => 'required',
        ],
        [
            'email.required' => 'Eメールアドレスは必須入力です。',
            //'email.unique' => '入力されたEメールアドレスはすでに登録されています。',
        ]);

        /**
         * 管理者パスワード設定用画面のURL生成
         */
        $urls = [
            'valid' => URL::temporarySignedRoute(
                'admin_authpage.valid',
                now()->addMinutes(1),
            )
        ];
        //dd($urls);

        $mail = new AdminAuthPageSendMail($request,$urls);
        Mail::to($email)->send($mail);

        $setmsg = "管理者用アカウントメールを送信しました。確認ボタンを押下すると、モーダルを閉じます。";
        return response()->json(
            [
                "msg" => $setmsg
            ],
        );
    }

    public function adminaccount(User $user) {
        $users = $user->userModelGet(session('loginid'));
        foreach ($users as $ur) {
            $nickname = $ur->nickname;
            $loginid = $ur->loginid;
            $email = $ur->email;
        }
        return view('admin.adminaccount',compact('nickname','loginid','email'));
    }

    public function adminaccountsetting(Request $request, User $user) {
        $adminaccountdata = $request->all();
        $user->userModelUpdate('loginid',$adminaccountdata["loginid"],'nickname',$adminaccountdata["nickname"]);
        $user->userModelUpdate('loginid',$adminaccountdata["loginid"],'email',$adminaccountdata["email"]);
        $users = $user->userModelGet($adminaccountdata["loginid"]);
        $setmsg = "設定変更しました。";
        return response()->json(
            [
                "msg" => $setmsg,
                "users" => $users
            ],
        );
    }

    public function usersearch() {
        return view('admin.usersearch');
    }

    public function usersearchAjax(Request $request, User $user) {
        $userword = $request->all();
        $users = $user->userModelWhere($userword['logintimes'],$userword['times']);
        return response()->json(
            [
                "data" => $users
            ],
        );
    }

    public function getcsv(Request $request) {
        $request = $request->all();
        $users = [
            ['name' => '太郎', 'age' => 24],
            ['name' => '花子', 'age' => 21]
        ];
        // カラムの作成
        $head = ['名前', '年齢'];
   
        // 書き込み用ファイルを開く
        $f = fopen('test.csv', 'w');
        if ($f) {
            // カラムの書き込み
            mb_convert_variables('SJIS', 'UTF-8', $head);
            fputcsv($f, $head);
            // データの書き込み
            foreach ($users as $user) {
               mb_convert_variables('SJIS', 'UTF-8', $user);
               fputcsv($f, $user);
            }
        }
        // ファイルを閉じる
        fclose($f);

        header("Content-Type: application/octet-stream");
        header('Content-Length: '.filesize('.csv'));
        header('Content-Disposition: attachment; filename=test.csv');
        readfile('test.csv');

        return view('admin.usersearch', compact('users'));
    }

    public function adminonetimepass(Request $request, User $user) {
        //$this->validator($request->all())->validate();
        /**
         * 管理者用のログインID取得
         */
        $loginid = $user->userModelSearch('user_value_id',2,'loginid');
        $data = $request->all();
        /**
         * シークレットキー作成
         */
        $g2fa = app('pragmarx.google2fa');
        $request->session()->flash('google2fa_secret', $data);
        $data["google2fa_secret"] = $g2fa->generateSecretKey();

        /**
         * userテーブルの管理者レコード(secret_keyカラム)にシークレットキー登録
         */
        $user->userModelUpdate('loginid',$loginid,'secret_key',$data["google2fa_secret"]);


        $users = $user->userModelGet($loginid);
        foreach ($users as $ur) {
            $email = $ur->email;
        }

        // $opturl = "otpauth://totp/" + encodeURIComponent($loginid) + "/?" +
        // "issuer=" + encodeURIComponent(config('app.')) + "&" +
        // "secret=" + encodeURIComponent($data["google2fa_secret"]);

        // $QR_img = 'https://chart.apis.google.com/chart?cht=qr&chs=200x200&' + encodeURIComponent($opturl);

        $opturl = "otpauth://totp/Laravel:".$email."/?".
        "issuer=".config('app.name')."&".
        "secret=".$data["google2fa_secret"];

        $QR_img = 'https://chart.apis.google.com/chart?cht=qr&chs=300x300&chld=LI0&chl='.$opturl;

        return view('admin.adminonetimepass',compact('QR_img'));
    }
}
