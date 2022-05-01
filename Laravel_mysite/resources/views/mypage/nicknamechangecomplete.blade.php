
<?php
    $title = 'ニックネーム変更完了';
?>

@include('include.header')

    @include('block.title')

        <div class="form-group">
            <div class="text-center">
                <p class="help-block">ニックネーム変更しました。</p>
                <a class="btn btn-primary" href="/mypage" role="button">マイページへ</a>
            </div>
        </div>

    @include('block.endtitle')
    
@include('include.footer')