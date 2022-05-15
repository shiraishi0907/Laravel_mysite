<?php
    $title = 'ワンタイムパスワード入力';
?>

@include('include.header')

    @include('block.title')

        <form action="/admincontentstop" method="POST">
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
            @if($errors->has('onetimepass'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('onetimepass') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">ログイン</button>
                <input type="hidden" name="onepass" value="on">
                <input type="hidden" name="accountid" value="{{ $accountid }}">
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <a class="btn btn-primary" href="/login" role="button">戻る</a>
                </div>
            </div>
        </form>
    
    @include('block.endtitle')
