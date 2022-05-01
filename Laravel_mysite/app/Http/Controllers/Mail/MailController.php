<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;  
use App\Models\User;

class MailController extends Controller
{
    private function newpassshuffle() {
        $str = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
        $shuffle = "";
        for ($i = 0; $i < 8; $i++) {
            $shuffle .= $str[rand(0, count($str)-1)];
        }
        return $shuffle;
    }

    public function mail($key,$nickname,$email,$params) {
        require '../vendor/autoload.php';
        require '../vendor/phpmailer/phpmailer/language/phpmailer.lang-ja.php';  

        switch ($key) {
            case 'loginid':
                $user = new User;
                $email = $user->userModelSearch('nickname',$nickname,'email');
                $mailaddress = $email[0];
                $loginid = $user->userModelSearch('nickname',$nickname,'loginid');
                $mailheader = '<p>ログインIDをお送りします。</p>';
                $mailbody = '<p>'.$nickname.'様のログインIDは、以下の通りです。</p><br>
                ログインID:'.$loginid[0];
                break;
            case 'passreset':
                $mailaddress = $email;
                /**
                * メールが送られた時のtimestamp取得
                */
                $timestamp = time(); 
                $timestamp = (string) $timestamp;
                /**
                * URLハッシュ化するための文字列用意
                */
                $makeHash = Hash::make('P1eAsE_MaKe[P@ssw0rd?a十>h@SH');
                $hash = hash('sha512', $makeHash);
                $url = 'http://localhost:8888/passwd_reset/'.$timestamp.'/'.$hash;
                $mailheader = 'パスワード再設定用URL';
                $mailbody = '<p>パスワード再設定用URLをお送りします。URLの有効期限は5分間です。</p><br>
                            <p>URL：<a href='.$url.'>'.$url.'</a></p>';
                break;
            case 'adminassignment':
                $mailaddress = $email;
                /**
                * メールが送られた時のtimestamp取得
                */
                $timestamp = time(); 
                $timestamp = (string) $timestamp;
                /**
                * URLハッシュ化するための文字列用意
                */
                $makeHash = Hash::make('P1eAsE_MaKe[P@ssw0rd?a十>h@SH');
                $hash = hash('sha512', $makeHash);
                $url = 'http://localhost:8888/admin_register/'.$timestamp.'/'.$hash;
                $mailheader = '管理者権限アカウント作成用URL';
                $mailbody = '<p>管理者権限アカウント作成用URLをお送りします。URLの有効期限は5分間です。</p><br>
                            <p>URL：<a href='.$url.'>'.$url.'</a></p>';
                break;
            case 'opinion':
                $mailaddress = $email;
                $mailheader = 'ご意見投稿ありがとうございます。';
                $mailbody = '<p>ご意見投稿ありがとうございます。ご意見は、有効活用させていただきます。</p><br>
                            *************************************************************<br>
                            氏名: '.$params['nickname'].'<br>
                            ご意見値タイトル: '.$params['opiniontitle'].'<br>
                            ご意見値ジャンル: '.$params['opiniongenre'].'<br>
                            ご意見: '.$params['opinionbody'].'<br>
                            *************************************************************<br>';
                break;
        }
            
        mb_language("japanese");
        mb_internal_encoding("UTF-8");

        // インスタンスを生成（引数に true を指定して例外 Exception を有効に）
        $mail = new PHPMailer(true);
        //日本語用設定
        $mail->CharSet = 'UTF-8'; //文字化け防止
        //エラーメッセージ用言語ファイルを使用する場合に指定
        $mail->setLanguage('ja', 'vendor/phpmailer/phpmailer/language/');

        try {
            //サーバの設定
            $mail->SMTPDebug = 0;  // デバッグの出力を有効に（テスト環境での検証用）
            $mail->isSMTP();   // SMTP を使用
            $mail->Host       = 'smtp.mailtrap.io';  // SMTP サーバーを指定
            $mail->SMTPAuth   = true;   // SMTP authentication を有効に
            $mail->Username   = '99da34975d191f';  // SMTP ユーザ名
            $mail->Password   = '977dd88a4f6abb';  // SMTP パスワード
            $mail->SMTPSecure = 'tls';  // 暗号化を有効に
            $mail->Port       = 2525;  // TCP ポートを指定
            //受信者設定
            //※名前などに日本語を使う場合は文字エンコーディングを変換
            //差出人アドレス, 差出人名
            $mail->setFrom('laravel-work-site@example.com', 'サイト管理者');
            //受信者アドレス, 受信者名（受信者名はオプション）
            $mail->addAddress($mailaddress);
            //コンテンツ設定
            $mail->isHTML(true);   // HTML形式を指定
            //メール表題（文字エンコーディングを変換）
            $mail->Subject = mb_encode_mimeheader($mailheader, 'ISO-2022-JP');
            //HTML形式の本文（文字エンコーディングを変換）
            $mail->Body  = $mailbody;
            $mail->send();  //送信
        } catch (Exception $e) {
            //エラーが発生した場合
            echo '捕捉した例外: ',  $e->getMessage(), "\n";
        }
    }

}
