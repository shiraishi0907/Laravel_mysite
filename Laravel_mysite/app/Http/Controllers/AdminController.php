<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Mail\MailController;
use PragmaRX\Google2FA\Google2FA;

class AdminController extends Controller
{
    protected function passRehash($data) {
        $crypt = crypt($data,'$5$rounds=30000$7VRXjNsd93fsy9ci58C1xKu1');
        return hash_equals($crypt,crypt($data,$crypt));
    }

    public function adminregister($timestamp,$hash) {
        $clickTime = time(); 
        $clickTime = (string) $clickTime;

        $data = $timestamp;
        $data .= $hash;

        if ($this->passRehash($data)) { //ハッシュが不正なものでないか？
            if (($clickTime - $timestamp) < 60 * 5) { //5分経ってないか
                return view('admin.adminregister'); //パスワード設定画面に遷移
            } else {
                return redirect('/login'); //パスワード設定申請画面にリダイレクト
            }
        } else {
            return redirect('/login'); //パスワード設定申請画面にリダイレクト
        }
    }

    public function adminregistercomplete(Request $request, User $user) {
        //登録されたら、users tableのレコードのパスワードとuser_value_id(2に変更)を更新し、メールを飛ばす
        if (!$user->userModelExist('loginid',$request->loginid)) {
            $user->userModelInsert($request->loginid,NULL,$request->password,$request->email,2); //ここおかしい
        } else {
            $user->userModelUpdate('loginid',$request->loginid,'password',$request->password);
            $user->userModelUpdate('loginid',$request->loginid,'updated_at',now());
        }
        return view('admin.adminregister');
    }

    public function adminpage() {
        return view('admin.adminpage');
    }

    public function adminlink() {
        return view('admin.adminlink');
    }

    //管理者権限付与ページにモーダルで送信完了文言を表示
    public function adminlinkcomplete(Request $request) {
        $adminlinkdata = $request->all();
        $mail = new MailController;
        $mail->mail('adminassignment',NULL,$adminlinkdata["email"],NULL);
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
        
        $data = $request->all();
        /**
         * シークレットキー作成
         */
        $g2fa = app('pragmarx.google2fa');
        $request->session()->flash('google2fa_secret', $data);
        $data["google2fa_secret"] = $g2fa->generateSecretKey();

        session(['loginid' => 'account']); //削除
        /**
         * userテーブルの管理者レコード(secret_keyカラム)にシークレットキー登録
         */
        $user->userModelUpdate('loginid',session('loginid'),'secret_key',$data["google2fa_secret"]);


        $users = $user->userModelGet(session('loginid'));
        foreach ($users as $ur) {
            $loginid = $ur->loginid;
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
