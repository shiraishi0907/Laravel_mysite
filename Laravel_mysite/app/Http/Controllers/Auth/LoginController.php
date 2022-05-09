<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\Rankingsetting;
use App\Models\Work;
use App\Models\Attribute;
use App\Models\Printorderjsid;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request, User $user) {
        //dd(Auth::user());
        /**
         * 新規作成画面から遷移
         * loginid ログインID
         * email Eメールアドレス
         * nickname ニックネーム
         * password パスワード
         */
        if ($request->register) { 
            $loginid = $request->loginid;
            $email = $request->email;
            $nickname = $request->nickname;
            $password = $request->password;

            $request->validate([
                'loginid' => 'required|unique:users',
                'email' => 'required|unique:users',
                'nickname' => 'required',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
            ],
            [
                'loginid.required' => 'ログインIDは必須入力です。',
                'loginid.unique' => '入力されたログインIDはすでに登録されています。',
                'email.required' => 'Eメールアドレスは必須入力です。',
                'email.unique' => '入力されたEメールアドレスはすでに登録されています。',
                'nickname.required' => 'ニックネームは必須入力です。',
                'password.confirmed' => 'パスワードとパスワード確認が一致しません。',
                'password.required' => 'パスワードは必須入力です。',
                'password_confirmation.required' => 'パスワード確認は必須入力です。',
            ]);

            /**
             * usersテーブルに登録
             * 一般ユーザーで登録
             */
            $user->userModelInsert($loginid,$nickname,$password,$email,1);
        /**
         * 管理者用パスワード設定画面から遷移
         */
        } elseif ($request->adminregister) {
            $password = $request->password;

            $request->validate([
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
            ],
            [
                'password.confirmed' => 'パスワードとパスワード確認が一致しません。',
                'password.required' => 'パスワードは必須入力です。',
                'password_confirmation.required' => 'パスワード確認は必須入力です。',
            ]);

            $user->userModelUpdate('user_value_id',2,'password',Hash::make($password));
        /**
         * トップページのログインリンクから遷移
         * すでにログインしている場合トップページにリダイレクト
         */
        } else {  
            if (session('loginid')) return redirect('/top');
        }

        return view('auth.login');

    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect('/top');
    }

    public function contentstop(Request $request, Work $work, User $user, Attribute $attribute, Printorderjsid $printorderjsid, Rankingsetting $rankingsetting) {
        /**
         * パスワード設定画面から遷移
         * new_password 新しいパスワード
         */
        if ($request->passreset) { 
            $newpassword = $request->new_password;

            $request->validate([
                'new_password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
            ],
            [
                'new_password.required' => '新しいパスワードは必須入力です。',
                'new_password.confirmed' => '新しいパスワードと新しいパスワード確認が一致しません。',
                'password_confirmation.required' => '新しいパスワード確認は必須入力です。',
            ]);
        /**
         * ログイン画面から遷移
         */
        } elseif ($request->login) {
            $loginid = $request->loginid;
            $password = $request->password;

            $request->validate([
                'loginid' => 'required|exists:users,loginid',
                'password' => 'required',
            ],
            [
                'loginid.required' => 'ログインIDは必須入力です。',
                'loginid.exists' => '入力されたログインIDとパスワードのアカウントが見つかりません。', //直す
                'password.required' => 'パスワードは必須入力です。',
            ]);

            /**
             * 管理者でログインした場合、ログインした際の各カラムは更新せず、
             * 先に二要素認証画面へ遷移(ログインIDをリクエストパラメータとして渡す)、その後各カラムを更新。
             */
            if ($user->userModelSearch('loginid',$loginid,'user_value_id') == 2) return redirect('/adminonetimepass');

            
            session(['loginid' => $loginid]);

            /**
             * ログインした際の各カラムの更新
             * login_number_of_times ログイン回数 1増やす
             * last_display_login_time 最終ログイン日時 現在ログイン日時に更新
             * next_display_login_time 現在ログイン日時 現在の日時をセット
             * updated_at 更新日
             */
            $users = $user->userModelGet($loginid);
            foreach ($users as $ur) {
                $user->userModelUpdate('loginid',$loginid,'login_number_of_times',$ur->login_number_of_times + 1);
                $user->userModelUpdate('loginid',$loginid,'last_display_login_time',$ur->next_display_login_time);
                $user->userModelUpdate('loginid',$loginid,'next_display_login_time',date('Y-m-d H:i:s'));
                $user->userModelUpdate('loginid',$loginid,'updated_at',now());
            }
        /**
         * トップページ画面のヘッダーから遷移
         */
        } else {
            
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
        $contentstop['attributes'] = $attribute->attributeModelGet();
        /**
         * ランキングタイトル、ランキング切り替えの表示
         * ログインしているユーザーが設定しているデフォルト表示を取得
         * 未ログインユーザーは「全ユーザーのおすすめランキング」をデフォルト表示にする
         */
        if (session('loginid')) {
            $rankingsettings = $rankingsetting->rankingsettingFlagModelGet(session('loginid'));
        } else {
            $rankingsettings = $rankingsetting->rankingsettingFlagModelGet('Guest');
        }
        foreach ($rankingsettings as $rankingsetting) {
            $contentstop['table_title'] = $rankingsetting->table_title;
            $contentstop['button_name'] = $rankingsetting->button_name;
        }

        return view('contentstop',compact('contentstop'));
    }
}