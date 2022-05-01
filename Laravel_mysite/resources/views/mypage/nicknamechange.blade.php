
<?php
    $title = 'ニックネーム変更';
?>

@include('include.header')

    @include('block.title')

        <form action="/nickname_change/complete" method="POST">
            @csrf
            <strong class="text-muted">現在のニックネーム</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input class="form-control" placeholder="現在のニックネーム" type="text" name="nownickname">
                </div> 
            </div> 
            <strong class="text-muted">新しいニックネーム</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" placeholder="新しいニックネーム" type="text" name="newnickname">
                </div> 
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">変更</button>
                </div> 
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <a class="btn btn-primary" href="/mypage" role="button">戻る</a>
                </div>
            </div>
        </form>

    @include('block.endtitle')

@include('include.footer')
   