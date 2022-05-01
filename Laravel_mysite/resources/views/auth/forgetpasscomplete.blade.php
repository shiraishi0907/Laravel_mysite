<?php
    $title = 'パスワード設定用URL送信完了';
?>

@include('include.header')

    @include('block.title')

        <div class="form-group">
            <div class="text-center">
                <p class="help-block">パスワード設定用URLをメールにお送りしました。パスワード設定用URLにアクセスして、パスワードを再設定してください。</p>
                <p class="text-danger">※回線の混雑状況によっては、メールが届かない場合があります。その際は以下のリンクをクリックしてください。</p>
            </div>
        </div>
        <div class="form-group">
            <div class="text-center">
                <p class="text-center"><a href="#" class="btn">メールが届かない場合</a></p>
            </div>
        </div>

    @include('block.endtitle')

@include('include.footer')
