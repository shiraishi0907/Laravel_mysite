
<?php
    $title = 'パスワード設定';
?>

@include('include.NonHeader')

    @include('block.title')

        <form action="/top" method="POST">
            @csrf
            <strong class="text-muted">新しいパスワード</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" placeholder="新しいパスワード" type="password" name="new_password">
                </div> 
            </div> 
            <strong class="text-muted">新しいパスワード確認</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" placeholder="新しいパスワード確認" type="password" name="password_confirmation">
                </div> 
            </div> 
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">設定</button>
                <input type="hidden" name="passreset" value="on">
            </div> 
        </form>

    @include('block.endtitle')
    
    
