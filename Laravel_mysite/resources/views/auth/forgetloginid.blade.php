
<?php
    $title = 'ログインIDをお忘れの場合';
?>

@include('include.header')

    @include('block.title')

        <form action="/loginid_reset/complete" method="POST">
            @csrf
            <strong class="text-muted">ニックネーム</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="ニックネーム" name="name" value="{{ old('name') }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @else
                        <div class="invalid-feedback">必須入力です。</div>
                    @endif
                </div> 
            </div> 
            <div class="form-group">
                <div class="input-group">
                    <p class="text-danger">※ログインIDを登録したEメールアドレスにお送りしますので、登録したニックネームを入力してください。</p>
                </div>
            </div>
            
            <div class="form-group">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">送信</button>
                </div> 
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <a class="btn btn-primary" href="/login" role="button">ログインへ戻る</a>
                </div>
            </div>
        </form>

    @include('block.endtitle')
    