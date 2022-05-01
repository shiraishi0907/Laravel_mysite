
@php
    $title = 'ログイン画面';
@endphp

@include('include.header')

    @include('block.title')

        <form action="/" method="POST">
            @csrf
            <strong class="text-muted">ログインID</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input class="form-control @if($errors->has('loginid')) is-invalid @endif" placeholder="ログインID" type="text" name="loginid" value="{{ old('loginid') }}" required>
                    @if($errors->has('loginid'))
                        <div class="invalid-feedback">{{ $errors->first('loginid') }}</div>
                    @else
                        <div class="invalid-feedback">必須入力です。</div>
                    @endif
                </div> 
            </div> 
            <strong class="text-muted">パスワード</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="パスワード" type="password" name="password" required>
                    @if($errors->has('password'))
                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                    @else
                        <div class="invalid-feedback">必須項目です。</div>
                    @endif
                </div> 
            </div> 
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">ログイン</button>
                <input type="hidden" name="login" value="on">
            </div> 
            <div class="form-group">
                <p class="text-center"><a href="/loginid_reset" class="btn">ログインIDをお忘れの方</a></p>
                <p class="text-center"><a href="/passwd_reset" class="btn">パスワードをお忘れの方</a></p>
                <p class="text-center"><a href="/register" class="btn">アカウントを作成</a></p>
            </div> 

            <div id="app-2">
                <span v-bind:title="message">
                    Hover your mouse over me for a few seconds
                    to see my dynamically bound title!
                </span>
            </div>
        </form>

    @include('block.endtitle')

@include('include.footer')

   
    