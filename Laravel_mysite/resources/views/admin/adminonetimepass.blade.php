<?php
    $title = 'ワンタイムパスワード入力';
?>

@include('include.header')

    @include('block.title')

        <form action="/onetimepass" method="POST">
            @csrf
            <strong class="text-muted">QRコード</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend" style="text-align: center">
                        <img src="{{ $QR_img }}" width="300" height="300">
                    </div>
                </div> 
            </div> 
            <strong class="text-muted">ワンタイムパスワード</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input class="form-control" placeholder="ワンタイムパスワード" type="text" name="onetimepass">
                </div> 
            </div> 
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">ログイン</button>
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <a class="btn btn-primary" href="/login" role="button">戻る</a>
                </div>
            </div>
        </form>
    
    @include('block.endtitle')
