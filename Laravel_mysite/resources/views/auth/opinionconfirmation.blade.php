
<?php
    $title = 'ご意見投稿確認';
?>

@include('include.header')

    @include('block.title')

        <form action="/opinion/complete" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <strong class="text-center">ニックネーム</strong>
                        </div>
                    </div>
                </div> 
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <p class="text-center">{{ $nickname }}</p>
                            <input type="hidden" name="name" value="{{ $nickname }}">
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <strong class="text-center">ご意見タイトル</strong>
                        </div>
                    </div>
                </div> 
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <p class="text-center">{{ $opiniontitle }}</p>
                            <input type="hidden" name="opiniontitle" value="{{ $opiniontitle }}">
                        </div>
                    </div>
                </div> 
            </div> 
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <strong class="text-center">ご意見ジャンル</strong>
                        </div>
                    </div>
                </div> 
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <p class="text-center">{{ $opiniongenre }}</p>
                            <input type="hidden" name="opiniongenre" value="{{ $opiniongenre }}">
                        </div>
                    </div>
                </div> 
            </div> 
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <strong class="text-center">ご意見</strong>
                        </div>
                    </div>
                </div> 
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <p class="text-center">{{ $opinionbody }}</p>
                            <input type="hidden" name="opinionbody" value="{{ $opinionbody }}">
                        </div>
                    </div>
                </div> 
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">送信</button>
                </div> 
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <a class="btn btn-primary" href="/opinion" role="button">戻る</a>
                </div>
            </div>
        </form>
        
    @include('block.endtitle')

@include('include.footer')
