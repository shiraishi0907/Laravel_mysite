<?php
    $title = 'ご意見投稿完了';
    
?>

@include('include.header')

    @include('block.title')

        <div class="form-group">
            <div class="text-center">
                <p class="help-block">送信完了しました。送信が完了した場合、送信が完了したメールが届きます。<br>また、貴重なご意見ありがとうございます。より良いサイトにしていくべく活用させていただく場合がございます。</p>
                <a href="/" class="btn btn-primary" role="button">トップへ戻る</a>
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
