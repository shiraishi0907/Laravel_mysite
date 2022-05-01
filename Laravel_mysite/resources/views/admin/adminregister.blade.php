<?php
    $title = '管理者用アカウント新規作成';
?>

@include('include.header')

    @include('block.title')

        <form action="/login" method="POST">
            @csrf
            <strong class="text-muted">ニックネーム</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input class="form-control" placeholder="ニックネーム" type="text" name="name" value="admin_user" readonly>
                </div> 
            </div> 
            <strong class="text-muted">ログインID</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input class="form-control" placeholder="ログインID" type="text" name="loginid" value="admin_user" readonly>
                </div> 
            </div> 
            <strong class="text-muted">Eメールアドレス</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input class="form-control" placeholder="Eメールアドレス" type="email" name="email" value="admin@gmail.com" readonly>
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
                <button type="submit" class="btn btn-primary btn-block">アカウント登録</button>
                <input type="hidden" name="register" value="user">
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <a class="btn btn-primary" href="/login" role="button">戻る</a>
                </div>
            </div>
        </form>
    
    @include('block.endtitle')
