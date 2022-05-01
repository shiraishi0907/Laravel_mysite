
<?php
    $title = '管理者用アカウント新規作成';
?>

@include('include.Nonheader')

    @include('block.title')

        <form action="/login" method="POST">
            @csrf
            <strong class="text-muted">ログインID</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input class="form-control" placeholder="ログインID" type="text" name="loginid">
                </div> 
            </div> 
            <strong class="text-muted">パスワード</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" placeholder="パスワード" type="password" name="password">
                </div> 
            </div> 
            <strong class="text-muted">パスワード確認</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" placeholder="パスワード確認" type="password" name="passwordconf">
                </div> 
            </div> 
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">管理者用アカウント登録</button>
                <input type="hidden" name="register" value="admin">
            </div> 
        </form>

    @include('block.endtitle')

@include('include.footer')