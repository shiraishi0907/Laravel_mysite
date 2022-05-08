
<?php
    $title = 'ご意見投稿';
?>

@include('include.header')

    @include('block.title')

        <form action="/opinion/conf" method="POST">
            @csrf
            <strong class="text-muted">ニックネーム</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input class="form-control" placeholder="ニックネーム" type="text" name="name" value="{{ $nickname }}" readonly>
                </div> 
            </div> 
            <strong class="text-muted">ご意見タイトル</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input class="form-control" placeholder="ご意見タイトル" type="text" name="opiniontitle">
                </div> 
            </div> 
            @if($errors->has('opiniontitle'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('opiniontitle') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <strong class="text-muted">ご意見ジャンル</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" placeholder="ご意見ジャンル" type="text" name="opiniongenre">
                </div> 
            </div> 
            @if($errors->has('opiniongenre'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('opiniongenre') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <script>
                $('#opinionbody').maxlength({
                    alwaysShow: true
                });
            </script>

            <strong class="text-muted">ご意見</strong>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <textarea class="form-control" id="opnionbody" name="opinionbody" rows="8" placeholder="本サイトにおけるご意見を250文字以内で入力"></textarea>
                </div> 
            </div> 
            @if($errors->has('opinionbody'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('opinionbody') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">確認</button>
                </div> 
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <a class="btn btn-primary" href="/top" role="button">戻る</a>
                </div>
            </div>
        </form>
    </div>
</body>

@include('include.footer')
