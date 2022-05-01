
<?php
    $title = 'パスワードをお忘れの場合';
?>

@include('include.header')

    @include('block.title')

        <form action="/passwd_reset/complete" method="POST">
            @csrf
            <strong class="text-muted">Eメールアドレス</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input class="form-control" placeholder="Eメールアドレス" type="email" name="email">
                </div> 
            </div> 
            <div class="form-group">
                <div class="input-group">
                    <p class="text-danger">※パスワード設定用URLをメールを送りますので、登録したメールアドレスを入力してください。</p>
                </div>
            </div>
            <div class="form-group">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">送信</button>
                </div> 
            </div>
            <div class="form-group">
                <div class="text-center">
                    <a class="btn btn-primary" href="/login" role="button">戻る</a>
                </div>
            </div>
        </form>
    
    @include('block.endtitle')
    