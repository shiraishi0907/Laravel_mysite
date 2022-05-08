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
            return view('auth.login');

        
        /**
         * トップページのログインリンクから遷移
         */
        } else {  
            return view('auth.login');
        }
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return view('contentstop');
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
                'loginid.exists' => '入力されたログインIDが見つかりません。',
                'password.required' => 'パスワードは必須入力です。',
            ]);

            //現在のログインと最終ログインを登録
            session(['loginid' => $loginid]);

            $users = $user->userModelGet(session('loginid'));
            foreach ($users as $ur) {
                $user->userModelUpdate('loginid',session('loginid'),'login_number_of_times',$ur->login_number_of_times + 1);
                $user->userModelUpdate('loginid',session('loginid'),'last_display_login_time',$ur->next_display_login_time);
                $user->userModelUpdate('loginid',session('loginid'),'next_display_login_time',date('Y-m-d H:i:s'));
                $user->userModelUpdate('loginid',session('loginid'),'updated_at',now());
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
         */
        $rankingsettings = $rankingsetting->rankingsettingFlagModelGet();
        foreach ($rankingsettings as $rankingsetting) {
            $contentstop['table_title'] = $rankingsetting->table_title;
            $contentstop['button_name'] = $rankingsetting->button_name;
        }

        
        return view('contentstop',compact('contentstop'));
    }
}