<?php
    $title = 'ログインID送信完了';
    
?>

@include('include.header')

    @include('block.title')

        <div class="form-group">
            <div class="text-center">
                <p class="text-danger">※ログインIDをメールに送信しました。回線の混雑状況によっては、メールが届かない場合があります。<br>その際は以下のリンクをクリックしてください。</p>
            </div>
        </div>
        <div class="form-group">
            <div class="text-center">
                <a class="btn btn-primary" href="/login" role="button">ログインへ戻る</a>
            </div>
        </div>
        <div class="form-group">
            <div class="text-center">
                <p class="text-center"><a href="#" class="btn">メールが届かない場合</a></p>
            </div>
        </div>

    @include('block.endtitle')

@include('include.footer')
