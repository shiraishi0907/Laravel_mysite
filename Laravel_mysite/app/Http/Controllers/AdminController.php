<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Mail\MailController;
use App\Mail\AdminAuthPageSendMail;
use App\Models\Attribute;
use App\Models\Printorderjsid;
use App\Models\Rankingsetting;
use App\Models\Work;
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

    /**
     * usersテーブルの管理者用アカウントのニックネームとEメールアドレスを更新
     * 更新された後、「設定変更しました。」のメッセージを表示し、更新内容を表示
     */
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

    public function usersearchajax(Request $request, User $user) {
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
        $accountid = $request->accountid;
        
        $request->validate([
            'onetimepass' => 'required',
        ],
        [
            'onetimepass.required' => 'ワンタイムパスワードは必須入力です。',
        ]);


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

        return view('admin.adminonetimepass',compact('QR_img','accountid'));
    }

    public function admincontentstop(Request $request, Work $work, User $user, Attribute $attribute, Printorderjsid $printorderjsid, Rankingsetting $rankingsetting) {
        $accountid = $request->accountid;
        $user->userModelUpdate('user_value_id',$accountid,'onetime_pass_flag',1);

        $loginid = $user->userModelSearch('user_value_id',$accountid,'loginid');
        session(['loginid' => $loginid]);

        $users = $user->userModelGet(session('loginid'));
        foreach ($users as $ur) {
            $user->userModelUpdate('loginid',session('loginid'),'login_number_of_times',$ur->login_number_of_times + 1);
            $user->userModelUpdate('loginid',session('loginid'),'last_display_login_time',$ur->next_display_login_time);
            $user->userModelUpdate('loginid',session('loginid'),'next_display_login_time',date('Y-m-d H:i:s'));
            $user->userModelUpdate('loginid',session('loginid'),'updated_at',now());
        }

        /**
         * おすすめの映画、アニメのタイトル、画像、URL
         */
        $workfilms = $work->workModelGet('workfilms',NULL,NULL);
        $workanimes = $work->workModelGet('workanimes',NULL,NULL);

        $i = 1;
        foreach ($workfilms as $work) {
            $contentstop['workfilm_title'][$i] = $work->title;
            $contentstop['workfilm_img'][$i] = $work->img;
            $contentstop['workfilm_url'][$i] = $work->url;
            $i++;
        }

        $i = 1;
        foreach ($workanimes as $work) {
            $contentstop['workanime_title'][$i] = $work->title;
            $contentstop['workanime_img'][$i] = $work->img;
            $contentstop['workanime_url'][$i] = $work->url;
            $i++;
        }

        /**
         * モーダル内の質問
         */
        $contentstop['attributes'] = $attribute->attributeModelGet('attrpage');
        /**
         * ランキングタイトル、ランキング切り替えの表示
         * ログインしているユーザーが設定しているデフォルト表示を取得
         * 未ログインユーザーは「全ユーザーのおすすめランキング」をデフォルト表示にする
         */
        $rankingsettings = $rankingsetting->rankingsettingFlagModelGet(session('loginid'));

        foreach ($rankingsettings as $rankingsetting) {
            $contentstop['table_title'] = $rankingsetting->table_title;
            $contentstop['button_name'] = $rankingsetting->button_name;
        }

        return view('contentstop',compact('contentstop'));

    }
}
