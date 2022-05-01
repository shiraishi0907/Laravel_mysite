<?php
    $title = 'レビュー投稿完了';
?>

@include('include.header')

    @include('block.title')

        <div class="form-group">
            <div class="text-center">
                <p class="help-block">レビュー投稿ありがとうございました。レビューは、他の利用者にも閲覧されます。</p>
                <a class="btn btn-primary" href="#" role="button" onclick="window.open('','_self').close();" >閉じる</a>
            </div>
        </div>

    @include('block.endtitle')

@include('include.footer')
